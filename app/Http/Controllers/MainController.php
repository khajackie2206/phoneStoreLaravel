<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
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
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductCategory;
use App\Models\Activity;
use App\Models\Brand;
use Illuminate\Validation\Rules\Exists;

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
        $bestSellers = $this->productService->getBestSellers();
        $goodProducts = $this->productService->getAllProducts();
        $sessionProducts = $this->cardService->getProduct();
        $bannerHeaders = $this->bannerService->getHeaderBanners();
        $staticHeaders = $this->bannerService->getStaticBanners();
        $broadcastBanner = $this->bannerService->getBroadcastBanner();
        $centerBanners = $this->bannerService->getCenterBanners();
        $topRatings = $this->productService->getTopRatings();
        // get all brands
        $brands = Brand::where('active', 1)->where('delete_at', null)->get();
        //get all categories
        $categories = ProductCategory::where('active', 1)->get();

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
            'bestSellers' => $bestSellers,
            'topRatings' => $topRatings,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    public function userDetail()
    {
        $user = User::where('email', session()->get('user')['email'])->first();
        $sessionProducts = $this->cardService->getProduct();

        // get all brands
        $brands = Brand::where('active', 1)->where('delete_at', null)->get();
        //get all categories
        $categories = ProductCategory::where('active', 1)->get();

        //get total price of order of a user
        $totalPrice = Order::where('user_id', $user->id)->sum('total');
        // dd($totalPrice);

        return view('user.detail', [
            'user' => $user,
            'title' => 'Thông tin cá nhân',
            'sessionProducts' => $sessionProducts,
            'carts' => session()->get('carts'),
            'totalPrice' => $totalPrice,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    public function changePasswordPage(User $user)
    {
        $user = User::where('email', session()->get('user')['email'])->first();
        $sessionProducts = $this->cardService->getProduct();

        // get all brands
        $brands = Brand::where('active', 1)->where('delete_at', null)->get();
        //get all categories
        $categories = ProductCategory::where('active', 1)->get();

        return view('user.change-password', [
            'user' => $user,
            'title' => 'Cập nhật mật khẩu',
            'sessionProducts' => $sessionProducts,
            'carts' => session()->get('carts'),
            'categories' => $categories,
            'brands' => $brands
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
        Alert::success('Đổi mật khẩu thành công, mời bạn đăng nhập lại');

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

        session()->put('user', $user);

        Alert::success('Cập nhật thông tin thành công');

        return redirect()->back();
    }

    public function trackOrder(Request $request)

    {
        $input = $request->all();
        $user = session()->get('user');
        $status = 0;

        if (!isset($input['status'])) {
            $orders = $this->cardService->getOrders($user)->orderBy('created_at', 'DESC')->paginate(3);
        } else {
            $orders = $this->cardService->getOrders($user)->where('status_id', $input['status'])->orderBy('created_at', 'DESC')->paginate(1000);
            $status = $input['status'];
        }

        // get all brands
        $brands = Brand::where('active', 1)->where('delete_at', null)->get();
        //get all categories
        $categories = ProductCategory::where('active', 1)->get();
        $sessionProducts = $this->cardService->getProduct();


        return view('product.order-tracking', [
            'title' => 'Đơn hàng của tôi',
            'carts' => session()->get('carts'),
            'sessionProducts' => $sessionProducts,
            'orders' => $orders,
            'user' => $user,
            'categories' => $categories,
            'brands' => $brands,
            'status' => $status
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
        $orders = Order::with(['user','payment', 'admin'])->where('deleted_at', null)->select('*');

        return Datatables::eloquent($orders)->addColumn('action', function ($order) {
            //get current user
            $admin = session()->get('user');

            return $admin->role == 1 ? '<a style="margin-left:5px; margin-right: 7px;" href="/admin/order/detail/' . $order->id . '"><i class="fas fa-edit fa-xl"></i></a>
                    <a href="/admin/order/delete/' . $order->id . '" onclick="return deleteOrder(event);"<i type="submit" style="color: red;margin-right: 20px;"
                    class="fas fa-trash fa-xl show-alert-delete-box"></i></a>' : '
                    <a style="margin-left:5px; margin-right: 25px;" href="/admin/order/detail/' . $order->id . '"><i class="fas fa-edit fa-xl"></i></a>';
        })->addColumn('admin', function ($order) {
            return !is_null($order->admin) ? '<span>' . $order->admin->name . '</span>' : '<span style="font-style: italic;">*Chưa duyệt*</span>';
        })->editColumn('created_at', function ($order) {
            return  '<span style="font-weight: bold;">' . $order->created_at->format('d.m.Y') . '</span>';
        })->editColumn('total', function ($order) {
            return  '<span style="color:red;font-weight: bold;"> ' . number_format($order->total) . ' <span style="text-decoration: underline;">đ</span></span>';
        })->rawColumns(['action', 'total', 'created_at', 'admin'])->make();
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

        $user = session()->get('user');
        // get time now with format Y-m-d H:i:s
        $time = Carbon::now()->format('Y-m-d H:i:s');

        if ($order->voucher_id != null) {
            $discount = Voucher::where('id', $order->voucher_id)->first();
        }

        $data = [
            'title' => 'Chi tiết đơn hàng',
            'order' => $order,
            'discount' => $discount ?? null,
            'user' => $user,
            'time' => $time
        ];

        $pdf = Pdf::loadView('pdf.generatePDF', $data);
        $pdf->set_option('isRemoteEnabled', true);
        $pdf->render();

        return $pdf->stream('itsolutionstuff.pdf')->header('Content-Type', 'application/pdf');;
    }

    public function generateOrderPDF()
    {
        $orders = Order::all();
        //get user data from session
        $user = session()->get('user');
        // get time now with format Y-m-d H:i:s
        $time = Carbon::now()->format('Y-m-d H:i:s');
        $data = [
            'title' => 'Danh sách đơn hàng',
            'orders' => $orders,
            'user' => $user,
            'time' => $time
        ];

        $pdf = Pdf::loadView('pdf.generateOrderPDF', $data);
        $pdf->set_option('isRemoteEnabled', true);
        $pdf->render();

        return $pdf->stream('listOrder.pdf')->header('Content-Type', 'application/pdf');;
    }

    public function exportCSV()
    {
        $file_name = 'orders_' . date('Y_m_d_H_i_s') . '.csv';

        return Excel::download(new OrderExport, $file_name);
    }

    public function exportExcel()
    {
        $file_name = 'orders_' . date('Y_m_d_H_i_s') . '.xlsx';

        return Excel::download(new OrderExport, $file_name);
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $input = $request->all();

        if ($input['status'] == 5) {
            $this->cancelOrder($order);
        }

        $order->update(array('status_id' => $input['status']));

        if ($input['status'] == 2) {
            $user = session()->get('user');
            $dataActivity = [
                'staff_id' => $user->id,
                'action' => 'Duyệt đơn hàng (Mã đơn hàng: #' . $order->id . ')',
            ];
            $order->staff_id = $user->id;
            $order->save();

            Activity::create($dataActivity);
        }

        Alert::success('Cập nhật trạng thái đơn hàng thành công!');

        return redirect()->back();
    }

    public function customerUpdateStatus(Request $request, Order $order)
    {
        $input = $request->all();
        $order->update(array('status_id' => $input['status']));
        if ($input['status'] == 5) {
            $orderDetails = $order->orderDetails;
            foreach ($orderDetails as $orderDetail) {
                $product = Product::where('id', $orderDetail->product_id)->first();
                $product->update(array('quantity' => $product->quantity + $orderDetail->quantity));
            }

            Alert::success('Đã hủy đơn hàng!');
        }

        if ($input['status'] == 4) {
            Alert::success('Đã xác nhận!');
        }


        return redirect()->back();
    }

    //function to handle after cancel order
    public function cancelOrder(Order $order)
    {
        $orderDetails = $order->orderDetails;
        foreach ($orderDetails as $orderDetail) {
            $product = Product::where('id', $orderDetail->product_id)->first();
            $product->update(array('quantity' => $product->quantity + $orderDetail->quantity));
        }

        //insert activity
        $user = session()->get('user');
        $dataActivity = [
            'staff_id' => $user->id,
            'action' => 'Hủy đơn hàng (Mã đơn hàng: #' . $order->id . ')',
        ];

        Activity::create($dataActivity);

        Alert::success('Đã hủy đơn hàng!');

        return redirect()->back();
    }

    public function delete(Order $order)
    {
        if ($order->status_id == 1) {
            $order->update(array('status_id' => 5));
            $orderDetails = $order->orderDetails;
            foreach ($orderDetails as $orderDetail) {
                $product = Product::where('id', $orderDetail->product_id)->first();
                $product->update(array('quantity' => $product->quantity + $orderDetail->quantity));
            }
            $order->update(array('deleted_at' => Carbon::now()));

            Alert::success('Đã xóa đơn hàng');
            return redirect()->back();
        }

        if ($order->status_id == 2) {
            Alert::error('Không thể xóa đơn hàng đã được xác nhận');
            return redirect()->back();
        }

        if ($order->status_id == 4) {
            Alert::error('Không thể xóa đơn hàng đã giao thành công');
            return redirect()->back();
        }

        if ($order->status_id == 3) {
            Alert::error('Không thể xóa đơn hàng đang được giao');
            return redirect()->back();
        }

        $order->update(array('deleted_at' => Carbon::now()));

        Alert::success('Đã xóa đơn hàng');
        return redirect()->back();
    }
}
