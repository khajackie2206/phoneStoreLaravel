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
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    protected $productService;

     public function __construct(ProductService $productService)
    {
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

    public function getAllProducts()
    {
        $products = Product::Paginate(8);

        return view('admin.product.list-product', [
            'products' => $products
        ]);
    }

    public function storeProduct(Request $request)
    {
        $params = $request->all();
        $this->productService->create($params);
        return redirect()->back();
    }

    public function getProductDetail(int $id)
    {
        $product = $this->productService->getProductDetail($id);
        
        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->short_description,
            'thumbs' => $product->images->where('type', 'cover'),
            'colors' => $product->colors,
            'brand'=> $product->brand->name,
        ];
    }

       public function detail(int $id)
    {
        $product = $this->productService->getProductDetail($id);
        $productsSameBrand = $this->productService->getAllProducts();
        
        return view( 'product.product-detail',[
            'title' => 'Chi tiết sản phẩm',
            'product' => $product,
            'productBrands' => $productsSameBrand
        ]);
    }

    public function showEdit(Product $product)
    {
        $colors = Color::get();
        $features = Feature::get();
        $memories = Memory::get();
        $vendors = Vendor::get();
        $brands = Brand::get();
        $categories = ProductCategory::get();
        return view('admin.product.edit-product',[
            'title'=>'Chỉnh sửa sản phẩm',
            'product'=>$product,
            'colors' => $colors,
            'features' => $features,
            'memories' => $memories,
            'vendors' => $vendors,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $result = $this->productService->updateProduct($request->all(), $product);
        if ($result) {
            return redirect('/admin/product/list');
        }

        return redirect()->back();
    }
}
