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
use App\Http\Requests\ValidateChangePassword;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

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

    public function changePasswordPage(Request $request, User $user)
    {
        $user = User::where('email', session()->get('user')['email'])->first();
        $sessionProducts = $this->cardService->getProduct();

        return view('user.change-password', [
            'user' => $user,
            'title' => 'Cập nhật mật khẩu',
            'sessionProducts' => $sessionProducts,
            'carts' => session()->get('carts'),
        ]);
    }

    public function changePassword(ValidateChangePassword $request, User $user)
    {
        $input = $request->all();
        $dataUpdate = array(
            'password' => Hash::make($input['new-pass']),
        );

       if (Hash::check($input['new-pass'], $user->password)) {
          Alert::error('Mật khẩu mới không được trùng với mật khẩu cũ');
          return redirect()->back();
        }

        $user->update($dataUpdate);
        Session::flush();
        Alert::success('Thành công', 'Đổi mật khẩu thành công, mời bạn đăng nhập lại');

        return redirect()->route('user-login');
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
        $orders = $this->cardService->getOrders($user)->orderBy('created_at', 'DESC')->paginate(3);
        $sessionProducts = $this->cardService->getProduct();

        return view('product.order-tracking', [
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
        $orders = Order::where('created_at', '<>', null)->orderBy('created_at', 'DESC');
        if (isset($input['search']) && $input['search'] !== "") {
            $orders->where('');
        }

        $results = $orders->Paginate(10);
        return view('admin.order.list', [
            'title' => 'Danh sách đơn hàng',
            'orders' => $results
        ]);
    }

    public function getData()
     {
         $orders = Order::select(['id','user_id','total','status_id', 'payment_id','created_at']);

         return Datatables::of($orders)->addColumn('action', function ($order) {
             return '<a style="margin-left:20px; margin-right: 7px;" href="/admin/order/detail/'.$order->id.'"><i class="fas fa-edit fa-xl"></i></a>
                    <a href="/admin/order/delete/'.$order->id.'" onclick="return deleteOrder(event);"<i type="submit" style="color: red;"
                    class="fas fa-trash fa-xl show-alert-delete-box"></i></a>' ;
         })->editColumn('user_id', function ($order) {
             return  '<span style="font-weight: bold;">'.$order->user->name.'</span>';
         })->editColumn('created_at', function ($order) {
             return  '<span style="font-weight: bold;">'.$order->created_at->format('d.m.Y H:i:s').'</span>';
         })->editColumn('total', function ($order) {
             return  '<span style="color:red;font-weight: bold;"> '.number_format($order->total).' <span style="text-decoration: underline;">đ</span></span>';
         })->rawColumns(['action', 'user_id', 'total', 'created_at'])->make();
     }

    public function show(Order $order)
    {
        if ($order->voucher_id != null) {
            $discount = Voucher::where('id', $order->voucher_id)->first();
        }
        return view('admin.order.detail', [
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
        $pdf->set_option('isRemoteEnabled', true);
        $pdf->render();

        return $pdf->stream('itsolutionstuff.pdf')->header('Content-Type', 'application/pdf');
        ;
    }

    public function updateOrderStatus(Request $request, Order $order)
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
        if ($input['status'] == 5) {
            Alert::success('Đã hủy đơn hàng!');
        }
        if ($input['status'] == 4) {
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
