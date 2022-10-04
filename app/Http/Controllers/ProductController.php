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
use App\Http\Requests\ValidateAddProduct;
use Carbon\Carbon;

class ProductController extends Controller
{
    protected $productService;
    protected $cardService;
    const LIMIT = 3;

    public function __construct(ProductService $productService, CardService $cardService)
    {
        $this->productService = $productService;
        $this->cardService = $cardService;
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
        $products = Product::Paginate(8)->where('delete_at', '=', null);

        return view('admin.product.list-product', [
            'products' => $products
        ]);
    }

    public function storeProduct(ValidateAddProduct $request)
    {
        $params = $request->all();
        $result =  $this->productService->create($params);
        if ($result) {
            Alert::success('Thành công', 'Thêm sản phẩm thành công');
            return redirect('/admin/product/list');
        }

        Alert::error('Lỗi', 'Thêm sản phẩm lỗi');
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
            'brand' => $product->brand->name,
        ];
    }

    public function detail(int $id)
    {
        $product = $this->productService->getProductDetail($id);
        $productsSameBrand = $this->productService->getAllProducts();
        $sessionProducts = $this->cardService->getProduct();

        return view('product.product-detail', [
            'title' => 'Chi tiết sản phẩm',
            'product' => $product,
            'productBrands' => $productsSameBrand,
            'sessionProducts' => $sessionProducts,
            'carts' => session()->get('carts')
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
        return view('admin.product.edit-product', [
            'title' => 'Chỉnh sửa sản phẩm',
            'product' => $product,
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
            Alert::success('Thành công', 'Cập nhật sản phẩm thành công');
            return redirect('/admin/product/list');
        }

        Alert::error('Lỗi', 'Cập nhật sản phẩm lỗi');
        return redirect()->back();
    }

    public function delete(Product $product)
    {
        Product::where('id', $product->id)->update(array('delete_at' => Carbon::now()));

        Alert::success('Thành công', 'xóa sản phẩm thành công');
        return redirect()->back();
    }

    public function Search(Request $request)
    {
        $output = '<div class="viewed" style="width: 400px;height: 35px;background: #f5f5f5; font-size: 13px; color: #666; font-weight: 400; padding: 7px; border: light grey 1px;">Sản phẩm gợi ý</div>';
        $products = Product::where('name', 'LIKE', '%' . $request->search . '%')->limit(3)->get();
        if (count($products) > 0) {
            foreach ($products as $product) {
                $output .= '<a href="/products/details/' . $product->id . '" class="list-group-item list-group-item-action border-1" style="width: 400px;">
            <table style="border-bottom:none;">
               <tr>
                  <td rowspan="2" style="width: 90px; height: 60px;"><img src="' . $product->images->where('type', 'cover')->first()['url'] . '" style="width: 80px; height: 70px;"></td>
                  <td style="font-weight:bold;width: 220px; height: 1px;">' . $product->name . '</td>
               </tr>
               <tr>
                  <td style="color:red;width: 200px; height: 1px;">' . number_format($product->price) . ' đ</td>
               </tr>
            </table>
            </a>';
            }
        } else $output = '<a  class="list-group-item list-group-item-action border-1" style="width: 300px;text-align:center;">Không tìm thấy kết quả</a>';

        return response()->json($output);
    }

    public function filterPage()
    {
        $products = $this->productService->getAllProducts();
        $sessionProducts = $this->cardService->getProduct();
        $brands = Brand::get();
        $features = Feature::get();

        return view('product.filter-product', [
            'title' => 'Danh sách sản phẩm',
            'products' => $products,
            'sessionProducts' => $sessionProducts,
            'carts' => session()->get('carts'),
            'brands' => $brands,
            'features' => $features,
        ]);
    }

    public function filter(Request $request)
    {
        $output = '';
        $flex = '';
        $input = $request->all();
        $brands = explode(',', $input['ids']);
        $products = '';
        if (!isset($input['ids'])) {
            $products = Product::get();
        } else {
            $products = Product::whereIn('brand_id', $brands)->get();
        }
        $count = 0;

        foreach ($products as $product) {
            $count++;
            $output .= '<div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="/products/details/' . $product->id . '">
                                                         <img src="' . $product->images->where('type', 'cover')->first()['url'] . '"
                                                     style="width: 120px;height:120px;">
                                                    </a>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="/products/details/' . $product->id . '">' . $product->brand->name . '</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name" href="/products/details/' . $product->id . '">' . $product->name . '</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price"> <p style="color: red; font-weight:bold;">
                                                            ' . number_format($product->price) . ' đ</p></span>
                                                        </div>
                                                    </div>
                                                  <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="/products/details/' . $product->id . '">ĐẶT MUA NGAY</a></li>
                                                    <li>
                                                        <p productId="' . $product->id . '" title="quick view"
                                                            class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><i class="fa fa-eye"></i>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>' ; 

          $flex .= ' <div class="row product-layout-list">
                                            <div class="col-lg-3 col-md-5 ">
                                               <div class="product-image">
                                                    <a href="/products/details/'.$product->id.'">
                                                         <img src="'.$product->images->where('type', 'cover')->first()['url'].'"
                                                     style="width: 190px;height:190px;">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-7">
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="#">'.$product->brand->name.'</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name" href="single-product.html">'.$product->name.'</a></h4>
                                                        <div class="price-box">
                                                             <span class="new-price"> <p style="color: red; font-weight:bold;">
                                                            '.number_format($product->price).' đ</p></span>
                                                        </div>
                                                        <p>'.$product->short_description.'</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="shop-add-action mb-xs-30">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart"><a href="/products/details/'.$product->id.'">ĐẶT MUA NGAY</a></li>
                                                        <li><a class="quick-view quick-view-btn" productId="'.$product->id.'" data-toggle="modal"
                                                                data-target="#exampleModalCenter" href="#"><i
                                                                    class="fa fa-eye"></i>Xem chi tiết</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>';
      } 

         if($count == 0){
          $output ='<div class="row justify-content-center"><h2>Không tìm thấy điện thoại</h2></div>';
         }
      
      return response()->json(['data' => $output, 'flex' => $flex]);

    }

    public function loadMore(Request $request)
    {
        $page = $request->input('page', default:0);
        $output = '';
        $flex = '';
        $products = $this->productService->get($page);
      //  dd($products);
         if(count($products)!=0){
             foreach($products as $product)
             {
                  $flex .= ' <div class="row product-layout-list">
                                                <div class="col-lg-3 col-md-5 ">
                                                    <div class="product-image">
                                                        <a href="/products/details/'.$product->id.'">
                                                            <img src="'.$product->images->where('type', 'cover')->first()['url'].'"
                                                                style="width: 190px;height:190px;">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-7">
                                                    <div class="product_desc">
                                                        <div class="product_desc_info">
                                                            <div class="product-review">
                                                                <h5 class="manufacturer">
                                                                    <a href="#">'.$product->brand->name.'</a>
                                                                </h5>
                                                                <div class="rating-box">
                                                                    <ul class="rating">
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                        <li class="no-star"><i class="fa fa-star-o"></i>
                                                                        </li>
                                                                        <li class="no-star"><i class="fa fa-star-o"></i>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <h4><a class="product_name"
                                                                    href="single-product.html">'.$product->name.'</a>
                                                            </h4>
                                                            <div class="price-box">
                                                                <span class="new-price">
                                                                    <p style="color: red; font-weight:bold;">
                                                                        '. number_format($product->price).' đ</p>
                                                                </span>
                                                            </div>
                                                            <p>'.$product->short_description.'</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="shop-add-action mb-xs-30">
                                                        <ul class="add-actions-link">
                                                            <li class="add-cart"><a
                                                                    href="/products/details/'.$product->id.'">ĐẶT MUA
                                                                    NGAY</a></li>
                                                            <li><a class="quick-view quick-view-btn"
                                                                    productId="'.$product->id.'" data-toggle="modal"
                                                                    data-target="#exampleModalCenter" href="#"><i
                                                                        class="fa fa-eye"></i>Xem chi tiết</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>';

                                             $output .= '<div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="/products/details/' . $product->id . '">
                                                         <img src="' . $product->images->where('type', 'cover')->first()['url'] . '"
                                                     style="width: 120px;height:120px;">
                                                    </a>
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="/products/details/' . $product->id . '">' . $product->brand->name . '</a>
                                                            </h5>
                                                            <div class="rating-box">
                                                                <ul class="rating">
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <h4><a class="product_name" href="/products/details/' . $product->id . '">' . $product->name . '</a></h4>
                                                        <div class="price-box">
                                                            <span class="new-price"> <p style="color: red; font-weight:bold;">
                                                            ' . number_format($product->price) . ' đ</p></span>
                                                        </div>
                                                    </div>
                                                  <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a href="/products/details/' . $product->id . '">ĐẶT MUA NGAY</a></li>
                                                    <li>
                                                        <p productId="' . $product->id . '" title="quick view"
                                                            class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><i class="fa fa-eye"></i>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                                </div>
                                            </div>
                                            <!-- single-product-wrap end -->
                                        </div>';
             }

            
            
            return response()->json(['data' => $output, 'flex' =>$flex]);
        }      
        return response()->json(['data' =>'', 'flex' => '']
            );  
    }
}
