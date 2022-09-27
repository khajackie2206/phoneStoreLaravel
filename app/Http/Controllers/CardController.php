<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Color;
use App\Models\Feature;
use App\Models\Memory;
use App\Models\Vendor;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\CardService;
use Illuminate\Pagination\Paginator;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use PhpParser\Node\Expr\FuncCall;

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
     $result = $this->cardService->create($params);

     if($result) {
          Alert::success('Thành công', 'Thêm sản phẩm vào giỏ hàng thành công');
         return redirect()->route('carts');
     }

       Alert::error('Đăng nhập', 'Đăng nhập để thêm vào giỏ hàng');
       return view('auth.login-register', [
           'title' => 'Đăng nhập',
        ]);
   }

   public function showCard()
   {
       $products = $this->cardService->getProduct();
       $sessionProducts = $this->cardService->getProduct();

       return view('product.card-product',[
           'title'=>'Giỏ hàng',
           'products'=> $products,
           'carts'=> session()->get('carts'),
           'sessionProducts' => $sessionProducts
      ]);
   }

   public function delete(Request $request, int $productId)
   {
        $carts = session()->get('carts');  
        $input = $request->all();

        if(count($carts[$productId]) > 1){
           unset($carts[$productId][$input['color']]);
        } else {
             unset($carts[$productId]);
        }

        session()->put('carts',$carts);
    
        Alert::success('Thành công', 'Xóa sản phẩm thành công');
        return redirect()->back();
   }

   public function update(Request $request, int $productId)
   {
      $input = $request->all();
      $carts = session()->get('carts');
      $product = Product::where('id', $productId)->first();
      $quantity = $input['quantity'];

      if( !is_numeric($quantity) && !is_int($quantity) )
      {
         Alert::error('Lỗi', 'Số lượng không hợp lệ');
        return redirect()->back();
      }

      if($quantity> $product->quantity)
      {
          $input['quantity'] = $product->quantity;
      }

      $carts[$productId][$input['color']]['quantity'] = $quantity;
      session()->put('carts', $carts);

      return redirect()->back();
   }
}
