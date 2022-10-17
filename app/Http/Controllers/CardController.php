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
use Illuminate\Support\Facades\Auth;
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

        if ($validator->fails() || ($params['quantity'] > $product->quantity) ) {
            Alert::error('Lỗi', 'Số lượng không hợp lệ');

            return redirect()->back();
        }
        $result = $this->cardService->create($params);
        $url = $params['url'];

        if ($result) {
            Alert::success('Thành công', 'Thêm sản phẩm vào giỏ hàng thành công');
            return redirect()->route('carts');
        }

        Alert::error('Đăng nhập', 'Đăng nhập để thêm vào giỏ hàng');
        return redirect('/login?url=' . $url . '');
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
        $user = session()->get('user');
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
        ]);
    }
}
