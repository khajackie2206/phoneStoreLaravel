<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Color;
use App\Models\Feature;
use App\Models\Memory;
use App\Models\Vendor;
use App\Models\Brand;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    protected $productService;

     public function __construct(ProductService $productService)
    {
        $this->middleware('auth');
        $this->productService = $productService;
    }

    public function index()
    {
        $colors = Color::get();
        $features = Feature::get();
        $memories = Memory::get();
        $vendors = Vendor::get();
        $brands = Brand::get();
        $categories = ProductCategory::get();
        return view('admin.product.add-product', [
            'colors' => $colors,
            'features' => $features,
            'memories' => $memories,
            'vendors' => $vendors,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    public function storeProduct(Request $request)
    {
        $params = $request->all();
        $this->productService->create($params);
        return redirect()->back();
    }
}
