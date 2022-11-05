<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use App\Services\BannerService;
use App\Services\CardService;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function trackOrder()
    {
        $user = session()->get('user');
        $orders = $this->cardService->getOrders($user)->orderBy('created_at' ,'DESC')->paginate(3);
        $sessionProducts = $this->cardService->getProduct();

        return view('product.order-tracking',[
            'title' => 'Đơn hàng của tôi',
            'carts' => session()->get('carts'),
            'sessionProducts' => $sessionProducts,
            'orders' => $orders,
            'user' => $user
        ]);
    }

    public function orders(Request $request)
    {
        $input = $request->all();
        $orders = Order::where('created_at','<>' ,null)->orderBy('created_at', 'DESC');
        if(isset($input['search']) && $input['search'] !== "")
        {
           $orders->where('');
        }

        $results = $orders->Paginate(10);
        return view('admin.order.list', [
            'title' => 'Danh sách đơn hàng',
            'orders' => $results
        ]);
    }

    public function show(Order $order)
    {
       if($order->voucher_id != null)
       {
           $discount = Voucher::where('id', $order->voucher_id)->first();
       }
       return view('admin.order.detail',[
           'title' => 'Chi tiết đơn hàng',
           'order' => $order,
           'discount' => $discount ?? null
       ]);
    }

    public function generatePDF(Order $order)
    {
        if ($order->voucher_id != null) {
            $discount = Voucher::where('id', $order->voucher_id)->first();
        }
        $data = [
            'title' => 'Chi tiết đơn hàng',
            'order' => $order,
            'discount' => $discount ?? null
        ];

        $pdf = Pdf::loadView('pdf.generatePDF', $data);
        $pdf->set_option('isRemoteEnabled', TRUE);
        $pdf->render();

        return $pdf->stream('itsolutionstuff.pdf')->header('Content-Type', 'application/pdf');;
    }

    public function updateOrderStatus(Request $request,Order $order)
    {
       $input = $request->all();
       $order->update(array('status_id' => $input['status']));
       Alert::success('Cập nhật trạng thái đơn hàng thành công!');

       return redirect()->back();
    }

    public function customerUpdateStatus(Request $request, Order $order)
    {
        $input = $request->all();
        $order->update(array('status_id' => $input['status']));
        if($input['status'] == 5) {
            Alert::success('Đã hủy đơn hàng!');
        }
        if($input['status'] == 4)
        {
            Alert::success('Đã xác nhận!');
        }

        return redirect()->back();
    }

    public function delete(Order $order)
    {
        Order::where('id', $order->id)->delete();

        return redirect()->back();
    }
}
