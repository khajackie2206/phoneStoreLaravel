<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateBanner;
use App\Models\Banner;
use App\Services\BannerService;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\Paginator;
use Spatie\QueryBuilder\QueryBuilder;
use Yajra\Datatables\Datatables;

class BannerController extends Controller
{
    private $bannerService;
    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index()
    {
        return view('admin.banner.add', [
            'title' => 'Thêm banner mới',
        ]);
    }

    public function storeBanner(ValidateBanner $request)
    {
        $input = $request->all();
        $result = $this->bannerService->store($input);
        if (!$result) {
            Alert::error('Lỗi', 'Thêm banner lỗi');
            return redirect()->back();
        }

        Alert::success('Thành công', 'Thêm banner thành công');
        return redirect()->route('banners');
    }

    public function getAllBanners()
    {
        $banners = Banner::Paginate(6);

        return view('admin.banner.list', [
            'title' => 'Danh sách banner',
            'banners' => $banners,
        ]);
    }

       public function getData()
     {
         $banners = Banner::select(['id','header','product_name','active', 'thumb','type_banner']);

         return Datatables::of($banners)->addColumn('action', function ($banner) {
             return '<a style="margin-left:20px; margin-right: 7px;" href="/admin/banner/edit/'.$banner->id.'"><i class="fas fa-edit fa-xl"></i></a>' ;
         })->editColumn('header', function ($banner) {
             return '<span style="font-weight: bold;">'.$banner->header.'</span>';
         })->editColumn('product_name', function ($banner) {
             return '<span style="font-weight: bold;">'.$banner->product_name.'</span>';
         })->editColumn('thumb', function ($banner) {
             return  ' <img src="'.$banner->thumb.'" width="100">';
         })->editColumn('active', function ($banner) {
             return  $banner->active == 1 ? '<span class="badge bg-success">Kích hoạt</span>' : '<span class="badge bg-danger">Hủy kích hoạt</span>';
         })->rawColumns(['action', 'header', 'product_name', 'thumb','active'])->make();
     }

      public function showEdit(Banner $banner)
    {
        return view('admin.banner.edit', [
            'title' => 'Chỉnh sửa banner',
            'banner' => $banner,
        ]);
    }

    public function update(ValidateBanner $request, Banner $banner)
    {
        $input = $request->all();
        $result = $this->bannerService->update($input, $banner);
        if ($result) {
            Alert::success('Thành công', 'Cập nhật banner thành công');
            return redirect()->route('banners');
        }

        Alert::error('Lỗi', 'Cập nhật banner lỗi');
        return redirect()->back();
    }

    public function delete(Banner $banner)
    {
        Banner::where('id', $banner->id)->delete();

        Alert::success('Thành công', 'xóa banner thành công');
        return redirect()->back();
    }
}
