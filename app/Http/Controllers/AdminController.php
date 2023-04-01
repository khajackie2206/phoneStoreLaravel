<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Session;
use App\Rules\MatchOldPassword;


class AdminController extends Controller
{

    //prepare data label for chartjs
    public function prepareDataForChart($data)
    {
        $labels = [];
        $chartData = [];
        foreach ($data as $item) {
            $labels[] = $item->status;
            $chartData[] = $item->total;
        }
        return [
            'labels' => $labels,
            'data' => $chartData,
        ];
    }

    public function prepareDataForChartWithName($data)
    {
        $labels = [];
        $chartData = [];
        foreach ($data as $item) {
            $labels[] = $item->name;
            $chartData[] = $item->total;
        }
        return [
            'labels' => $labels,
            'data' => $chartData,
        ];
    }

    public function prepareDataForRowChart($data)
    {
        $labels = [];
        $chartData = [];
        foreach ($data as $item) {
            $labels[] = $item['date'];
            $chartData[] = $item['total'];
        }
        return [
            'labels' => $labels,
            'data' => $chartData,
        ];
    }

    public function mapDataWith14DayAgo($data)
    {
        $dataMap = [];
        $date = now()->subDays(14);
        for ($i = 0; $i < 14; $i++) {
            $dataMap[$i]['date'] = $date->format('d-m');
            $dataMap[$i]['total'] = 0;
            foreach ($data as $item) {
                if ($item->date == $date->format('Y-m-d')) {
                    $dataMap[$i]['total'] = $item->total;
                }
            }
            $date->addDay();
        }
        //convert array to object and return
        return $dataMap;
    }

    public function index()
    {

        $orderNews = Order::where('created_at', '<>', null)->orderBy('created_at', 'DESC')->limit(8)->get();
        $orders = Order::where('created_at', '>=', now()->subWeek())->where('created_at', '<', now())->get();
        $paymentMethods = DB::table('orders')
            ->join('payments', 'orders.payment_id', '=', 'payments.id')
            ->select('payments.name as status', DB::raw('count(*) as total'))
            ->where('orders.status_id', '<>', 5)
            ->groupBy('payments.name')
            ->get();

        //caculate total price in table order_details with table orders with status in table statues is 4 in total 14 days ago to 7 days ago
        $totalAvanue2WeeksAgo = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('sum(order_details.total_price) as total'))
            ->where('orders.status_id', 4)
            ->where('orders.status_id', '<>', 5)
            ->orWhere('orders.payment_id', '<>', 1)
            ->where('orders.created_at', '>=', now()->subDays(14))
            ->where('orders.created_at', '<', now()->subDays(7))
            ->get();
        $totalAvanue2WeeksAgo = $totalAvanue2WeeksAgo[0]->total;

        //caculate total price in table order_details with table orders with status in table statues is 4 in total 7 days
        $totalAvanue = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('sum(order_details.total_price) as total'))
            ->where('orders.status_id', 4)
            ->where('orders.payment_id', '<>', 1)
            ->where('orders.created_at', '>=', now()->subDays(7))
            ->get();
        $totalAvanue =  $totalAvanue[0]->total;

        $increaseTotalAvanue = $this->caculateIncrease($totalAvanue, $totalAvanue2WeeksAgo);

        //caculate total order in table orders with status is 4 in total 14 days ago to 7 days ago
        $totalOrder2WeeksAgo = DB::table('orders')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('count(*) as total'))
            ->where('orders.status_id', 4)
            ->where('orders.status_id', '<>', 5)
            ->orWhere('orders.payment_id', '<>', 1)
            ->where('orders.created_at', '>=', now()->subDays(14))
            ->where('orders.created_at', '<', now()->subDays(7))
            ->get();

        $totalOrder2WeeksAgo = $totalOrder2WeeksAgo[0]->total;
        //caculate total order in table orders with status is 4 in total 7 days ago
        $totalOrder = DB::table('orders')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('count(*) as total'))
            ->where('orders.status_id', 4)
            ->where('orders.status_id', '<>', 5)
            ->orWhere('orders.payment_id', '<>', 1)
            ->where('orders.created_at', '>=', now()->subDays(7))
            ->get();
        $totalOrder = $totalOrder[0]->total;
        $increaseTotalOrder = $this->caculateIncrease($totalOrder, $totalOrder2WeeksAgo);

        // group total_price in table order_details with table orders within 12 days
        $totalPrices = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(DB::raw('sum(order_details.total_price) as total'), DB::raw('DATE(orders.created_at) as date'))
            ->where('orders.status_id', 4)
            ->where('orders.status_id', '<>', 5)
            ->orWhere('orders.payment_id', '<>', 1)
            ->where('orders.created_at', '>=', now()->subDays(14))
            ->groupBy('date')
            ->get();

        // group total order within 12 days
        $totalOrders = DB::table('orders')
            ->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))
            ->where('created_at', '>=', now()->subDays(14))
            ->groupBy('date')
            ->get();

        // caculate increase total user create account in 14 days ago to 7 days ago
        $totalUser2WeeksAgo = DB::table('users')
            ->select(DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(14))
            ->where('created_at', '<', now()->subDays(7))
            ->get();

        // caculate increase total user create account 7 days ago
        $totalUser = DB::table('users')
            ->select(DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(7))
            ->get();
        $increaseTotalUser = $this->caculateIncrease($totalUser[0]->total, $totalUser2WeeksAgo[0]->total);

        //caculate top 7 products with status is 4 in table order_details with table orders
        $topProducts = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(DB::raw('sum(order_details.quantity) as total'), 'products.name')
            ->where('orders.status_id', 4)
            ->where('orders.status_id', '<>', 5)
            ->orWhere('orders.payment_id', '<>', 1)
            ->groupBy('products.name')
            ->orderBy('total', 'desc')
            ->limit(7)
            ->get();

        $top7Product = $this->prepareDataForChartWithName($topProducts);
        $pieChartData = $this->prepareDataForChart($paymentMethods);
        $rowChartData = $this->mapDataWith14DayAgo($totalPrices);
        $formatRowChartData = $this->prepareDataForRowChart($rowChartData);
        $totalOrderData = $this->mapDataWith14DayAgo($totalOrders);
        $formatTotalOrderData = $this->prepareDataForRowChart($totalOrderData);

        $products = Product::get();
        $users = count(User::get());

        return view('admin.dashboard.dashboard', [
            'title' => 'Admin Dashboard',
            'users' => $users,
            'orderNews' => $orderNews,
            'orders' => $orders,
            'products' => $products,
            'pieChartData' => $pieChartData,
            'rowChartData' => $formatRowChartData,
            'totalOrderData' => $formatTotalOrderData,
            'increaseTotalAvanue' => $increaseTotalAvanue,
            'increaseTotalOrder' => $increaseTotalOrder,
            'increaseTotalUser' => $increaseTotalUser,
            'summary' => $totalAvanue,
            'top7Product' => $top7Product,
        ]);
    }

    //function caculate increase in total price in 7 days ago
    public function caculateIncrease($totalNow, $total2WeeksAgo)
    {
        $increase = 0;
        if ($total2WeeksAgo == 0) {
            $increase = 0;
        } else {
            $increase = ($totalNow - $total2WeeksAgo) / $total2WeeksAgo * 100;
        }
        return $increase;
    }

    public function getAllUsers()
    {
        $users = DB::table('users')->where('role', 0)->paginate(6);
        return view('admin.user.list', [
            'title' => 'Danh sách người dùng',
            'users' => $users
        ]);
    }

    public function getData()
    {
        $users = User::where('role', 0)->select(['id', 'name', 'email', 'active', 'avatar', 'phone']);

        return Datatables::of($users)->addColumn('action', function ($user) {
            return $user->active == 0 ? '<a style="margin-left: 20px;" onclick="return activeUser(event);" href="/admin/users/change-active/' . $user->id . '?active=1"><i class="fa fa-unlock fa-xl"></i></a>'
                : '<a style="margin-left: 20px;" href="/admin/users/change-active/' . $user->id . '?active=0" onclick="return blockUser(event);"><i type="submit" style="color: red;"
                    class="fa fa-lock fa-xl"></i></a>';
        })->editColumn('name', function ($user) {
            return ' <span style="font-weight: bold;">' . $user->name . '</span>';
        })->editColumn('avatar', function ($user) {
            return  '<img src="' . $user->avatar . '" width="40" style="border-radius: 50%;" >';
        })->editColumn('active', function ($user) {
            return  $user->active == 1 ? '<span class="badge bg-success">Kích hoạt</span>' : '<span class="badge bg-danger">Bị khóa</span>';
        })->editColumn('email', function ($user) {
            return  '<span style="font-weight: bold;">' . $user->email . '</span>';
        })->editColumn('phone', function ($user) {
            return  '<span style="font-weight: bold;">' . $user->phone . '</span>';
        })->rawColumns(['name', 'avatar', 'active', 'email', 'phone', 'action'])->make();
    }

    //list staff
    public function getAllStaff()
    {
        $staffs = DB::table('users')->where('role', 1)->paginate(6);

        return view('admin.staff.list', [
            'title' => 'Danh sách nhân viên',
            'staffs' => $staffs
        ]);
    }

    public function getStaffData()
    {
        $admins = Admin::where('role', 0)->select(['id', 'name', 'email', 'active', 'phone']);

        return Datatables::of($admins)->addColumn('action', function ($admin) {
            return $admin->active == 0 ? '<a style="margin-left: 5px;margin-right: 5px;" onclick="return activeStaff(event);" href="/admin/staffs/change-active/' . $admin->id . '?active=1"><i class="fa fa-unlock fa-xl"></i></a>
            <a style="margin-left: 5px;" href="/admin/staffs/delete/' . $admin->id . '" onclick="return deleteStaff(event);"<i type="submit" style="color: red;"
                    class="fas fa-trash fa-xl show-alert-delete-box"></i></a>'
                : '<a style="margin-left: 5px;margin-right: 5px;" href="/admin/staffs/change-active/' . $admin->id . '?active=0" onclick="return blockStaff(event);"><i type="submit" style="color: red;"
                    class="fa fa-lock fa-xl"></i></a>
                    <a style="margin-left: 5px;" href="/admin/staffs/delete/' . $admin->id . '" onclick="return deleteStaff(event);"<i type="submit" style="color: red;"
                    class="fas fa-trash fa-xl show-alert-delete-box"></i></a>';
        })->editColumn('name', function ($admin) {
            return ' <span style="font-weight: bold;">' . $admin->name . '</span>';
        })->editColumn('active', function ($admin) {
            return  $admin->active == 1 ? '<span class="badge bg-success">Kích hoạt</span>' : '<span class="badge bg-danger">Bị khóa</span>';
        })->editColumn('email', function ($admin) {
            return  '<span style="font-weight: bold;">' . $admin->email . '</span>';
        })->editColumn('phone', function ($admin) {
            return  '<span style="font-weight: bold;">' . $admin->phone . '</span>';
        })->rawColumns(['name', 'active', 'email', 'phone', 'action'])->make();
    }


    public function changeActive(Request $request, User $user)
    {
        $input = $request->all();
        $user->update(array('active' => $input['active']));

        return redirect()->back();
    }

    public function changeStaffActive(Request $request, Admin $admin)
    {
        $input = $request->all();
        $admin->update(array('active' => $input['active']));

        return redirect()->back();
    }

    public function deleteStaff(Admin $admin)
    {
        $admin->delete();

        Alert::success('Đã xóa tài khoản');
        return redirect()->back();
    }

    public function createStaff(Request $request)
    {
        //validate data input if password confirm not match
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password',
            'phone' => 'required|numeric',
            'address' => 'required',
        ], [
            'name.required' => 'Bạn chưa nhập tên nhân viên',
            'email.required' => 'Bạn chưa nhập email nhân viên',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại phải là số',
            'address.required' => 'Bạn chưa nhập địa chỉ',
            'password_confirmation.same' => 'Xác nhận mật khẩu không khớp'
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        $input['role'] = 0;
        $input['active'] = 1;

        Admin::create($input);

        Alert::success('Đã thêm nhân viên');
        return redirect()->back();
    }

    public function createStaffPage()
    {
        return view('admin.staff.add', [
            'title' => 'Thêm nhân viên'
        ]);
    }

    //get detail staff
    public function getDetail(Admin $admin)
    {
        return view('admin.staff.detail', [
            'title' => 'Chi tiết nhân viên',
            'admin' => $admin
        ]);
    }

    //update staff
    public function changeInfo(Request $request, Admin $admin)
    {
        $input = $request->all();
        $input['avatar'] = $input['thumb'];

        $admin->update($input);

        session()->put('user', $admin);

        Alert::success('Đã cập nhật thông tin nhân viên');
        return redirect()->back();
    }

    //change password page
    public function changePasswordPage(Admin $admin)
    {
        return view('admin.staff.change-password', [
            'title' => 'Đổi mật khẩu',
            'admin' => $admin
        ]);
    }

    //change password
    public function changePassword(Request $request, Admin $admin)
    {
      $this->validate($request, [
            'current_password' => ['required', new MatchOldPassword],
            'new-pass'      => 'required|min:6',
            're-new-pass'   => 'same:new-pass'
        ], [
            'current_password.required'  => 'Bạn phải nhập mật hiện tại',
            'current_password.min'       => 'Mật khẩu phải lớn hơn 6 kí tự',
            'new-pass.required'  => 'Mật khẩu mới là trường bắt buộc',
            'new-pass.min'       => 'Mật khẩu mới phải lớn hơn 6 kí tự',
            're-new-pass.same'   => 'Xác nhận mật khẩu mới không khớp'
        ]);

        $input = $request->all();
        $dataUpdate = array(
            'password' => Hash::make($input['new-pass']),
        );

        if (Hash::check($input['new-pass'], $admin->password)) {
            Alert::error('Mật khẩu mới không được trùng với mật khẩu cũ');
            return redirect()->back();
        }

        $admin->update($dataUpdate);
        Session::flush();
        Alert::success('Đổi mật khẩu thành công, mời bạn đăng nhập lại');

        return redirect()->route('login');
    }
}
