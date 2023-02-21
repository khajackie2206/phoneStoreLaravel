<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateBrand;
use Illuminate\Http\Request;
use App\Services\BrandService;
use App\Models\Brand;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;
use App\Models\Product;
use Yajra\Datatables\Datatables;

class BrandController extends Controller
{
    private $brandService;
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index()
    {
        return view('admin.brand.add', [
            'title' => 'Thêm thương hiệu mới',
        ]);
    }

    public function storeBrand(ValidateBrand $request)
    {
        $input = $request->all();
        $result = $this->brandService->store($input);
        if (!$result) {
            Alert::error('Lỗi', 'Thêm thương hiệu xảy ra lỗi');
            return redirect()->back();
        }

        Alert::success('Thành công', 'Thêm thương hiệu thành công');
        return redirect()->route('brands');
    }

    public function getAllBrands()
    {
        $brands = Brand::where('delete_at', null)->Paginate(6);

        return view('admin.brand.list', [
            'title' => 'Danh sách brand',
            'brands' => $brands,
        ]);
    }

     public function getData()
     {
         $brands = Brand::where('delete_at', null)->select(['id','name','country','image', 'active','description']);

         return Datatables::of($brands)->addColumn('action', function ($brand) {
             return '<a style="margin-left:20px; margin-right: 7px;" href="/admin/brand/edit/'.$brand->id.'"><i class="fas fa-edit fa-xl"></i></a>
                    <a href="/admin/brand/delete/'.$brand->id.'" onclick="return deleteBrand(event);"<i type="submit" style="color: red;"
                    class="fas fa-trash fa-xl show-alert-delete-box"></i></a>' ;
         })->editColumn('name', function ($brand) {
             return ' <span style="font-weight: bold;">'.$brand->name.'</span>';
         })->editColumn('image', function ($brand) {
             return  '<img src="'.$brand->image.'" width="50" >';
         })->editColumn('active', function ($brand) {
             return  $brand->active == 1 ? '<span class="badge bg-success">Kích hoạt</span>' : '<span class="badge bg-danger">Hủy kích hoạt</span>';
         })->editColumn('country', function ($brand) {
             return  '<span style="font-weight: bold;">'.$brand->country.'</span>';
         })->rawColumns(['name', 'image', 'action', 'active','country'])->make();
     }

    public function showEdit(Brand $brand)
    {
        return view('admin.brand.edit', [
            'title' => 'Chỉnh sửa thương hiệu',
            'brand' => $brand,
        ]);
    }

    public function update(ValidateBrand $request, Brand $brand)
    {
        $input = $request->all();
        $result = $this->brandService->update($input, $brand);

        if ($result) {
            Alert::success('Thành công', 'Cập nhật brand thành công');
            return redirect()->route('brands');
        }

        Alert::error('Lỗi', 'Cập nhật brand lỗi');
        return redirect()->back();
    }

    public function delete(Brand $brand)
    {
        Brand::where('id', $brand->id)->update(array('delete_at' => Carbon::now()));
        Product::where('brand_id', $brand->id)->update(array('delete_at' => Carbon::now()));

        return redirect()->back();
    }

    public function changeStatus(Request $request, Brand $brand)
    {
        $input = $request->all();
        $brand->update(array('active' => $input['active']));
        Product::where('brand_id', $brand->id)->update(array('active' => $input['active']));

        return redirect()->back();
    }
}
