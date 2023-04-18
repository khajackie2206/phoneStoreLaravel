<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Admin;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\WarehouseDetail;
use App\Models\WarehouseReceipt;
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

    public function mapDataWith7DayAgo($data)
    {
        $dataMap = [];
        $date = now()->subDays(7);
        for ($i = 0; $i < 7; $i++) {
            $dataMap[$i]['date'] = $date->format('d-m-Y');
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

    //map data with range date
    public function mapDataWithRangeDate($data, $startDate, $endDate)
    {
        $dataMap = [];
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        //how much date between start date and end date
        $totalDate = ($endDate - $startDate) / (60 * 60 * 24);

        for ($i = 0; $i <= $totalDate; $i++) {
            $dataMap[$i]['date'] = date('d-m-Y', $startDate);
            $dataMap[$i]['total'] = 0;
            foreach ($data as $item) {
                if ($item->date == date('Y-m-d', $startDate)) {
                    $dataMap[$i]['total'] = $item->total;
                }
            }
            $startDate = strtotime('+1 day', $startDate);
        }

        return $dataMap;
    }

    //return array of datetime in range date
    public function getRangeDate($startDate, $endDate)
    {
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        //how much date between start date and end date
        $totalDate = ($endDate - $startDate) / (60 * 60 * 24);
        $data = [];
        for ($i = 0; $i <= $totalDate; $i++) {
            $data[$i] = date('Y-m-d', $startDate);
            $startDate = strtotime('+1 day', $startDate);
        }
        return $data;
    }

    //map data with 7 month ago
    public function mapDataWith7MonthAgo($data)
    {
        // dd($data);
        $dataMap = [];
        $date = now()->subMonths(7);
        for ($i = 0; $i < 7; $i++) {
            $dataMap[$i]['date'] = $date->format('m-Y');
            $dataMap[$i]['total'] = 0;
            foreach ($data as $item) {
                if ($item->month == $date->format('m')) {
                    $dataMap[$i]['total'] = $item->total;
                }
            }
            $date->addMonth();
        }
        //convert array to object and return
        return $dataMap;
    }


    public function index()
    {

        $orders = Order::whereMonth('orders.created_at', '=', date('m'))->whereYear('orders.created_at', '=', date('Y'))->get();
        $paymentMethods = DB::table('orders')
            ->join('payments', 'orders.payment_id', '=', 'payments.id')
            ->select('payments.name as status', DB::raw('count(*) as total'))
            ->where('orders.status_id', 4)
            ->groupBy('payments.name')
            ->get();
        // caculate all order status of each in total
        $orderStatus = DB::table('orders')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select('statuses.name as status', DB::raw('count(*) as total'))
            ->groupBy('statuses.name')
            ->get();

        //caculate total price in table order_details with table orders with status in table statues is 4 in total 14 days ago to 7 days ago
        $totalAvanueLastMonth = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('sum(order_details.total_price) as total'))
            ->where('orders.status_id', 4)
            ->whereMonth('orders.created_at', '=', now()->subMonth()->month)
            ->whereYear('orders.created_at', '=', now()->subMonth()->year)
            ->get();
        $totalAvanueLastMonth = $totalAvanueLastMonth[0]->total;

        //caculate total price in table order_details with table orders with status in table statues is 4 in total 7 days
        $totalAvanue = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('sum(order_details.total_price) as total'))
            ->where('orders.status_id', 4)
            ->whereMonth('orders.created_at', '=', date('m'))
            ->whereYear('orders.created_at', '=', date('Y'))
            ->get();
        $totalAvanue =  $totalAvanue[0]->total;

        $increaseTotalAvanue = $this->caculateIncrease($totalAvanue, $totalAvanueLastMonth);


        $totalOrderLastMonth = DB::table('orders')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('count(*) as total'))
            ->whereMonth('orders.created_at', '=', now()->subMonth()->month)
            ->whereYear('orders.created_at', '=', now()->subMonth()->year)
            ->get();

        $totalOrderLastMonth = $totalOrderLastMonth[0]->total;

        $totalOrder = DB::table('orders')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('count(*) as total'))
            ->whereMonth('orders.created_at', '=', date('m'))
            ->whereYear('orders.created_at', '=', date('Y'))
            ->get();


        $totalOrder = $totalOrder[0]->total;
        $increaseTotalOrder = $this->caculateIncrease($totalOrder, $totalOrderLastMonth);

        // // group total_price in table order_details with table orders within 12 days
        // $totalPrices = DB::table('order_details')
        //     ->join('orders', 'order_details.order_id', '=', 'orders.id')
        //     ->select(DB::raw('sum(order_details.total_price) as total'), DB::raw('DATE(orders.created_at) as date'))
        //     ->where('orders.status_id', 4)
        //     ->where('orders.created_at', '>=', now()->subDays(7))
        //     ->groupBy('date')
        //     ->get();

        // group total order within 12 days
        $totalOrders = DB::table('orders')
            ->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))
            ->whereBetween('created_at', [now()->subDays(7)->format('Y-m-d'), now()->format('Y-m-d')])
            ->groupBy('date')
            ->get();

        // caculate increase total user create account in 14 days ago to 7 days ago
        $totalUserLastMonth = DB::table('users')
            ->select(DB::raw('count(*) as total'))
            ->whereMonth('users.created_at', '=', now()->subMonth()->month)
            ->whereYear('users.created_at', '=', now()->subMonth()->year)
            ->get();

        // caculate increase total user create account 7 days ago
        $totalUser = DB::table('users')
            ->select(DB::raw('count(*) as total'))
            ->whereMonth('users.created_at', '=', date('m'))
            ->whereYear('users.created_at', '=', date('Y'))
            ->get();
        $increaseTotalUser = $this->caculateIncrease($totalUser[0]->total, $totalUserLastMonth[0]->total);

        //caculate top 7 products with status is 4 in table order_details with table orders
        $topProducts = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(DB::raw('sum(order_details.quantity) as total'), 'products.name')
            ->where('orders.status_id', 4)
            ->groupBy('products.name')
            ->orderBy('total', 'desc')
            ->limit(7)
            ->get();
        // group total_price in table order_details with table orders within 7 months
        $totalPricesIn7Months = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(DB::raw('sum(order_details.total_price) as total'), DB::raw('MONTH(orders.created_at) as month'))
            ->where('orders.status_id', 4)
            ->where('orders.created_at', '>=', now()->subMonths(7))
            ->groupBy('month')
            ->get();


        $revenues = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total) as total'))
            ->where('status_id', 4)
            ->whereBetween('created_at', ['2023-04-02', '2023-04-17'])
            ->groupBy('date')
            ->get();
        //map revenue with range date
        $revenues = $this->mapDataWithRangeDate($revenues, '2023-04-02', '2023-04-17');
        $revenues = $this->prepareDataForRowChart($revenues);

        $dateRange = $this->getRangeDate(now()->subDays(7)->format('Y-m-d'), now()->format('Y-m-d'));

        //caculate total doanh thu in 7 days ago and group by date
        $totalPrices = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total) as total'))
            ->where('status_id', 4)
            ->whereBetween('created_at', [now()->subDays(7)->format('Y-m-d'), now()->format('Y-m-d')])
            ->groupBy('date')
            ->get();


        //foreach date in dateRange,caculate profit and map with date
        foreach ($dateRange as $date) {
            $totalDoanhThu = Order::where('status_id', 4)
                ->whereDate('created_at', $date)
                ->sum('total');
            $products = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->select('products.id', 'products.price', 'products.name', 'order_details.quantity', 'order_details.total_price')
                ->where('orders.status_id', 4)
                ->whereDate('orders.created_at', $date)
                ->get();
            $totalVon = 0;
            foreach ($products as $product) {
                $warehouseDetail = WarehouseDetail::where('product_id', $product->id)->first();
                if (!$warehouseDetail) {
                    $totalVon += $product->price * $product->quantity;
                } else {
                    $totalVon += $product->quantity * $warehouseDetail->price;
                }
            }
            $profit = $totalDoanhThu - $totalVon;
            if ($profit < 0) $profit = 0;
            $profitData[] = [
                'date' => $date,
                'total' => $profit,
            ];
        }
        $profitData = $this->prepareDataForRowChart($profitData);


        $top7Product = $this->prepareDataForChartWithName($topProducts);
        $pieChartData = $this->prepareDataForChart($paymentMethods);
        $pieChartOrderStatus = $this->prepareDataForChart($orderStatus);
        $rowChartData = $this->mapDataWith7DayAgo($totalPrices);
        $rowChartDataFor7Months = $this->mapDataWith7MonthAgo($totalPricesIn7Months);
        $formatRowChartDataFor7Months = $this->prepareDataForRowChart($rowChartDataFor7Months);
        $formatRowChartData = $this->prepareDataForRowChart($rowChartData);
        $totalOrderData = $this->mapDataWith7DayAgo($totalOrders);
        $formatTotalOrderData = $this->prepareDataForRowChart($totalOrderData);

        $products = Product::get();
        $users = count(User::get());

        return view('admin.dashboard.dashboard', [
            'title' => 'Admin Dashboard',
            'users' => $users,
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
            'rowChartDataFor7Months' => $formatRowChartDataFor7Months,
            'pieChartOrderStatus' => $pieChartOrderStatus,
            'profitData' => $profitData,
        ]);
    }

    //function caculate increase in total price in 7 days ago
    public function caculateIncrease($totalNow, $totalLastMonth)
    {
        $increase = 0;
        if ($totalLastMonth == 0) {
            $increase = 0;
        } else {
            $increase = ($totalNow - $totalLastMonth) / $totalLastMonth * 100;
        }
        return $increase;
    }

    public function getAllUsers()
    {
        $users = DB::table('users')->paginate(6);
        return view('admin.user.list', [
            'title' => 'Danh sách người dùng',
            'users' => $users
        ]);
    }

    public function getData()
    {
        $users = User::select(['id', 'name', 'email', 'active', 'avatar', 'phone']);

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
        $staffs = DB::table('admins')->where('role', 1)->paginate(6);

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

    //filter revenue by date from - to
    public function filterRevenue(Request $request)
    {
        $input = $request->all();
        $from = $input['startDate'];
        $to = $input['endDate'];

        //caculate total price in table orders with status_id is 4 in date from - to group by date

        $revenues = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total) as total'))
            ->where('status_id', 4)
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('date')
            ->get();

        $revenues = $this->mapDataWithRangeDate($revenues, $from, $to);
        $revenues = $this->prepareDataForRowChart($revenues);

        $dateRange = $this->getRangeDate($from, $to);
        //foreach date in dateRange,caculate profit and map with date
        foreach ($dateRange as $date) {
            $totalDoanhThu = Order::where('status_id', 4)
                ->whereDate('created_at', $date)
                ->sum('total');
            $products = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->select('products.id', 'products.price', 'products.name', 'order_details.quantity', 'order_details.total_price')
                ->where('orders.status_id', 4)
                ->whereDate('orders.created_at', $date)
                ->get();
            $totalVon = 0;
            foreach ($products as $product) {
                $warehouseDetail = WarehouseDetail::where('product_id', $product->id)->first();
                if (!$warehouseDetail) {
                    $totalVon += $product->price * $product->quantity;
                } else {
                    $totalVon += $product->quantity * $warehouseDetail->price;
                }
            }
            $profit = $totalDoanhThu - $totalVon;
            if ($profit < 0) {
                $profit = 0;
            }
            $profitData[] = [
                'date' => $date,
                'total' => $profit,
            ];
        }
        $profits = $this->prepareDataForRowChart($profitData);

        //return profits and revenues to ajax
        return response()->json([
            'profits' => $profits,
            'revenues' => $revenues
        ]);
    }

    //filter revenue by date from - to
    public function filterTime(Request $request)
    {
        $input = $request->all();
        $from = now()->subDays(7)->format('Y-m-d');
        $to = now()->format('Y-m-d');
        if ($input['time'] == '7ngay') {
            $from = now()->subDays(7)->format('Y-m-d');
            $to = now()->format('Y-m-d');
        } elseif ($input['time'] == 'thangtruoc') {
            $from = now()->subMonth()->startOfMonth()->format('Y-m-d');
            $to = now()->subMonth()->endOfMonth()->format('Y-m-d');
        } elseif ($input['time'] == 'thangnay') {
            $from = now()->startOfMonth()->format('Y-m-d');
            $to = now()->format('Y-m-d');
        } else {
            $from = now()->subMonth(2)->startOfMonth()->format('Y-m-d');
            $to = now()->format('Y-m-d');
        }

        //caculate total price in table orders with status_id is 4 in date from - to group by date

        $revenues = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total) as total'))
            ->where('status_id', 4)
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('date')
            ->get();

        $revenues = $this->mapDataWithRangeDate($revenues, $from, $to);
        $revenues = $this->prepareDataForRowChart($revenues);

        $dateRange = $this->getRangeDate($from, $to);
        //foreach date in dateRange,caculate profit and map with date
        foreach ($dateRange as $date) {
            $totalDoanhThu = Order::where('status_id', 4)
                ->whereDate('created_at', $date)
                ->sum('total');
            $products = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->select('products.id', 'products.price', 'products.name', 'order_details.quantity', 'order_details.total_price')
                ->where('orders.status_id', 4)
                ->whereDate('orders.created_at', $date)
                ->get();
            $totalVon = 0;
            foreach ($products as $product) {
                $warehouseDetail = WarehouseDetail::where('product_id', $product->id)->first();
                if (!$warehouseDetail) {
                    $totalVon += $product->price * $product->quantity;
                } else {
                    $totalVon += $product->quantity * $warehouseDetail->price;
                }
            }
            $profit = $totalDoanhThu - $totalVon;
            if ($profit < 0) {
                $profit = 0;
            }
            $profitData[] = [
                'date' => $date,
                'total' => $profit,
            ];
        }
        $profits = $this->prepareDataForRowChart($profitData);

        //return profits and revenues to ajax
        return response()->json([
            'profits' => $profits,
            'revenues' => $revenues
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
