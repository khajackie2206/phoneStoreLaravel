<?php

namespace App\Services;

use App\Jobs\SendMail;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Voucher;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductService.
 */
class CardService
{
    public function create(array $params)
    {
        $user = session()->get('user');

        if ($user) {
            $quantity = $params['quantity'];
            //$color = $params['color'];
            $product_id = $params['productId'];

            $carts = session()->get('carts');

            if (is_null($carts)) {
                session()->put('carts', [
                    $product_id => $quantity,
                ]);

                return true;
            }

            $exists = Arr::exists($carts, $product_id);

            if ($exists) {
                $carts[$product_id] = $carts[$product_id] + $quantity;
                session()->put('carts', $carts);

                return true;
            }

            $carts[$product_id] = $quantity;
            session()->put('carts', $carts);

            return true;
        }

        return false;
    }

    public function getProduct()
    {
        $carts = session()->get('carts');

        if (is_null($carts)) {
            return [];
        }

        $productId = array_keys($carts);

        return Product::where('active', 1)
            ->where('delete_at', null)
            ->whereIn('id', $productId)
            ->get();
    }

    public function update($request)
    {
        session()->put('carts', $request->input('num_product'));
        return true;
    }

    public function payment(array $input)
    {
        try {
            DB::beginTransaction();
            $discount = $input['discount_summary'] ?? null;
            $user = session()->get('user');
            $carts = session()->get('carts');

            if (isset($input['code'])) {
                $code = Voucher::where('code', $input['code'])->first();
                if ($code->quantity > 0) {
                    $quantity = $code->quantity - 1;
                    $dataQuantity = [
                        'quantity' => $quantity,
                    ];

                    $code->update($dataQuantity);
                }
            }

            if (isset($input['new_address'])) {
                $newAddressData = [
                    'address' => $input['new_address'],
                    'user_id' => $user->id,
                ];

                DeliveryAddress::create($newAddressData);
            }

            //Add data into orders table
            $orderData = [
                'status_id' => 1,
                'payment_id' => $input['payment_method'],
                'user_id' => $user->id,
                'order_date' => Carbon::now(),
                'note' => $input['note'],
                'total' => $input['summary'],
                'voucher_id' => $code->id ?? null,
                'delivery_address' => $input['new_address'] ?? $input['delivery_address'],
            ];

            $order = Order::create($orderData);
            $productId = array_keys(session()->get('carts'));
            $products = Product::where('active', 1)
                ->where('delete_at', null)
                ->whereIn('id', $productId)
                ->get();

            foreach ($products as $product) {
                if($carts[$product->id] > $product->quantity ) {
                   return false;
                }
                $productNewQuantity = $product->quantity - $carts[$product->id];
                $dataUpdateQuantity = [
                    'quantity' => $productNewQuantity,
                ];

                $orderDetailData = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $carts[$product->id],
                    'total_price' => $carts[$product->id] * ($product->price - $product->discount),
                ];

                $product->update($dataUpdateQuantity);

                OrderDetail::create($orderDetailData);
            }
            DB::commit();

            #Queue to send mail
            SendMail::dispatch($user->email, $user, $products, $carts, $input['new_address'] ?? $input['delivery_address'], $code->amount ?? null, $input['summary'])->delay(now()->addSecond(2));

            session()->forget('carts');
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }

        return true;
    }

    public function getOrders($user)
    {
        return $user->orders();
    }
}
