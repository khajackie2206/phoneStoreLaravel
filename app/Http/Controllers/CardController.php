<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\DeliveryAddress;
use App\Models\Product;
use App\Models\User;
use App\Services\CardService;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    protected $productService;
    protected $cardService;

    public function __construct(ProductService $productService, CardService $cardService)
    {
        $this->productService = $productService;
        $this->cardService = $cardService;
    }

    public function addCart(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'quantity' => 'required|numeric|integer|gt:0',
        ]);
        $product = Product::where('id', $params['productId'])->first();

        if ($validator->fails()) {
            Alert::error('Lỗi', 'Số lượng không hợp lệ');

            return redirect()->back();
        }

        if ($product->quantity === 0) {
            Alert::error('Sản phẩm này đã bán hết');

            return redirect()->back();
        }

        if ($params['quantity'] > $product->quantity) {
            Alert::error('Vượt quá số lượng sản phẩm trong kho');

            return redirect()->back();
        }

        $result = $this->cardService->create($params);

        if (!$result) {
            $url = $params['url'];
            Alert::error('Đăng nhập', 'Đăng nhập để thêm vào giỏ hàng');
            return redirect('/login?url=' . $url . '');
        }

        Alert::success('Thành công', 'Thêm sản phẩm vào giỏ hàng thành công');
        return redirect()->route('carts');
    }

    public function showCard()
    {
        $products = $this->cardService->getProduct();
        $sessionProducts = $this->cardService->getProduct();

        return view('product.card-product', [
            'title' => 'Giỏ hàng',
            'products' => $products,
            'carts' => session()->get('carts'),
            'sessionProducts' => $sessionProducts,
        ]);
    }

    public function delete(Request $request, int $productId)
    {
        $carts = session()->get('carts');

        unset($carts[$productId]);

        session()->put('carts', $carts);

        Alert::success('Thành công', 'Xóa sản phẩm thành công');
        return redirect()->back();
    }

    public function update(Request $request, int $productId)
    {
        $input = $request->all();
        $carts = session()->get('carts');
        $product = Product::where('id', $productId)->first();
        $quantity = $input['quantity'];

        $validator = Validator::make($input, [
            'quantity' => 'required|numeric|integer|gt:0',
        ]);

        if ($validator->fails()) {
            Alert::error('Lỗi', 'Số lượng không hợp lệ');
            return redirect()->back();
        }

        if ($quantity > $product->quantity) {
            $quantity = $product->quantity;
        }

        $carts[$productId] = $quantity;
        session()->put('carts', $carts);

        return redirect()->back();
    }

    public function adjust(Request $request, int $productId)
    {
        $input = $request->all();
        $carts = session()->get('carts');
        $product = Product::where('id', $productId)->first();
        if ($input['type'] == 'inc') {
            if ($carts[$productId] == $product->quantity) {
                return redirect()->back();
            }

            $carts[$productId] += 1;
            session()->put('carts', $carts);

            return redirect()->back();
        } else {
            if ($carts[$productId] == 1) {
                return redirect()->back();
            }
            $carts[$productId] -= 1;
            session()->put('carts', $carts);

            return redirect()->back();
        }
    }

    public function checkout()
    {
        $auth = session()->get('user');
        $user = User::where('id', $auth->id)->first();
        $addresses = DeliveryAddress::where('user_id', $user->id)->get();
        if (!$user) {
            Alert::error('Đăng nhập', 'Đăng nhập để thanh toán');
            return view('auth.login-register', [
                'title' => 'Đăng nhập',
            ]);
        }
        $products = $this->cardService->getProduct();
        $sessionProducts = $this->cardService->getProduct();

        return view('product.checkout', [
            'title' => 'Thanh toán sản phẩm',
            'products' => $products,
            'user' => $user,
            'carts' => session()->get('carts'),
            'sessionProducts' => $sessionProducts,
            'addresses' => $addresses
        ]);
    }

    public function payment(Request $request)
    {
        $input = $request->all();
        $result = $this->cardService->payment($input);
        if (!$result) {
            Alert::error('Xảy ra lỗi trong quá trình đặt hàng!');
            return redirect()->back();
        }

        Alert::success('Đặt hàng thành công');
        return redirect()->back();
    }

    public function paymentWithVNpay(Request $request)
    {
        $input = $request->all();


        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://allo-store.vn/products/checkout";
        $vnp_TmnCode = "H1YT811F"; //Mã website tại VNPAY
        $vnp_HashSecret = "WDQPUSPDNNJBDSNVELPJGNSXDUFXUHYF"; //Chuỗi bí mật

        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $input['summary'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $request->ip();
        //Add Params of 2.0.1 Version
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($input['redirect'])) {

            $input = $request->all();
            $result = $this->cardService->payment($input);
            if (!$result) {
                Alert::error('Xảy ra lỗi trong quá trình đặt hàng!');
                return redirect()->back();
            }

            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
