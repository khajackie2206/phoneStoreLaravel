<?php

namespace App\Services;

use App\Models\Feature;
use Illuminate\Support\Facades\Log;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductFeature;
use App\Models\ProductMemory;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Exception;
/**
 * Class ProductService.
 */
class CardService
{
    
    public function create(array $params)
    {
        $user = Auth::User();
  
        if($user){
        $quantity = $params['quantity'];
        $color = $params['color'];
        $product_id = $params['productId'];

        $carts = session()->get('carts');

        if (is_null($carts)) {
            session()->put('carts', [
                 $product_id => [
                     $color => [ 'color' => $color , 'quantity' => $quantity  ]
                  ]
            ]);

            return true;
        }
           
        $exists = Arr::exists($carts, $product_id);

        if ($exists) {

                $uniqueColor = Arr::exists($carts[$product_id], $color);
                
                if($uniqueColor){
                   
                 $carts[$product_id][$color]['quantity'] = $carts[$product_id][$color]['quantity'] + $quantity;
                session()->put('carts', $carts);
         
                return true;  
                }
        }

         $carts[$product_id][$color] = [ 'color' => $color, 'quantity' => $quantity];
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

}
