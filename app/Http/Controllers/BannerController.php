<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateBanner;
use App\Models\Banner;
use App\Services\BannerService;
use RealRashid\SweetAlert\Facades\Alert;

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
        if(!$result){
             Alert::error('Lỗi', 'Thêm banner lỗi');
            return redirect()->back();
        }

        Alert::success('Thành công', 'Thêm banner thành công');
        return redirect()->back();
    }

    public function getAllBanners()
    {
        $banners = Banner::get();

        return view('admin.banner.list', [
            'title' => 'Danh sách banner',
            'banners' => $banners
        ]);
    }

   public function delete(Banner $banner)
    {
        Banner::where('id', $banner->id)->delete();

        Alert::success('Thành công', 'xóa banner thành công');
        return redirect()->back();
    }
}
