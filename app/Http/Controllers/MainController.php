<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Services\BannerService;
use App\Services\CardService;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    protected $productService;
    protected $cardService;
    protected $bannerService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService, CardService $cardService, BannerService $bannerService)
    {
        $this->productService = $productService;
        $this->cardService = $cardService;
        $this->bannerService = $bannerService;
    }

    public function index()
    {
        $productsNewly = $this->productService->getProductsNewly();
        $productsDiscount = $this->productService->getProductsDiscount();
        $goodProducts = $this->productService->getAllProducts();
        $sessionProducts = $this->cardService->getProduct();
        $bannerHeaders = $this->bannerService->getHeaderBanners();
        $staticHeaders = $this->bannerService->getStaticBanners();
        $broadcastBanner = $this->bannerService->getBroadcastBanner();
        $centerBanners = $this->bannerService->getCenterBanners();

        return view('home', [
            'title' => 'Trang chủ',
            'productsNewly' => $productsNewly,
            'productsDiscount' => $productsDiscount,
            'goodProducts' => $goodProducts,
            'sessionProducts' => $sessionProducts,
            'carts' => session()->get('carts'),
            'bannerHeaders' => $bannerHeaders,
            'staticHeaders' => $staticHeaders,
            'broadcastBanner' => $broadcastBanner,
            'centerBanners' => $centerBanners,
        ]);
    }

    public function userDetail()
    {
        $user = User::where('email', session()->get('user')['email'])->first();
        $sessionProducts = $this->cardService->getProduct();

        return view('user.detail', [
            'user' => $user,
            'title' => 'Thông tin cá nhân',
            'sessionProducts' => $sessionProducts,
            'carts' => session()->get('carts'),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $input = $request->all();
        $dataUpdate = array(
            'name' => $input['name'] ?? null,
            'gender' => $input['gender'] ?? null,
            'phone' => $input['phone'] ?? null,
            'avatar' =>  $input['thumb'] ?? $input['file'],
            'address' => $input['address'] ?? null,
            'updated_at' => Carbon::now()
        );

        $user->update($dataUpdate);

        Alert::success('Thành công', 'Cập nhật thông tin thành công');

        return redirect()->back();
    }
}
