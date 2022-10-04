<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CardService;
use Illuminate\Http\Request;
use App\Services\ProductService;

class MainController extends Controller
{

    protected $productService;
    protected $cardService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService, CardService $cardService)
    {
        $this->productService = $productService;
        $this->cardService = $cardService;
    }

    public function index()
    {
        $productsNewly = $this->productService->getProductsNewly();
        $productsDiscount = $this->productService->getProductsDiscount();
        $goodProducts = $this->productService->getAllProducts();
        $sessionProducts = $this->cardService->getProduct();

        return view('home', [
            'title' => 'Trang chủ',
            'productsNewly' => $productsNewly,
            'productsDiscount' => $productsDiscount,
            'goodProducts' => $goodProducts,
            'sessionProducts' => $sessionProducts,
            'carts' => session()->get('carts')
        ]);
    }
}
