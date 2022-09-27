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

class ProductController extends Controller
{
    protected $productService;
    protected $cardService;

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
        $products = Product::Paginate(8)->where('delete_at', '=', null );

        return view('admin.product.list-product', [
            'products' => $products
        ]);
    }

    public function storeProduct(Request $request)
    {
        $params = $request->all();
         $result =  $this->productService->create($params);
         if($result){
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
            'brand'=> $product->brand->name,
        ];
    }

       public function detail(int $id)
    {
        $product = $this->productService->getProductDetail($id);
        $productsSameBrand = $this->productService->getAllProducts();
        $sessionProducts = $this->cardService->getProduct();
        
        return view( 'product.product-detail',[
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

    public function Search(Request $request){
        $output = '<div class="viewed" style="width: 400px;height: 35px;background: #f5f5f5; font-size: 13px; color: #666; font-weight: 400; padding: 7px; border: light grey 1px;">Sản phẩm gợi ý</div>';
        $products = Product::where('name','LIKE','%'.$request->search.'%')->limit(3)->get();
        if(count($products)>0){
        foreach ($products as $product){
            $output .= '<a href="/products/details/'.$product->id.'" class="list-group-item list-group-item-action border-1" style="width: 400px;">
            <table style="border-bottom:none;">
               <tr>
                  <td rowspan="2" style="width: 90px; height: 60px;"><img src="'.$product->images->where('type', 'cover')->first()['url'].'" style="width: 80px; height: 70px;"></td>
                  <td style="font-weight:bold;width: 220px; height: 1px;">'.$product->name.'</td>
               </tr>
               <tr>
                  <td style="color:red;width: 200px; height: 1px;">'.number_format($product->price).' đ</td>
               </tr>
            </table>
            </a>';
        }
    } else $output='<a  class="list-group-item list-group-item-action border-1" style="width: 300px;text-align:center;">Không tìm thấy kết quả</a>'; 
   
        return response()->json($output);
    }
}
