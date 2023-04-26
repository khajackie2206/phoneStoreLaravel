<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;

class StaffController extends Controller
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


    public function mapDataWith7DayAgo($data)
    {
        $dataMap = [];
        $date = now()->subDays(7);
        for ($i = 0; $i <= 7; $i++) {
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
        //caculate total comment in this month
        $totalComment = DB::table('comments')
            ->select(DB::raw('count(*) as total'))
            ->whereBetween('comments.created_at', [now()->startOfMonth(), now()->addDays(1)])
            ->get();

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
            ->where('orders.status_id', '<>', 5)
            ->orWhere('orders.payment_id', '<>', 1)
            ->where('orders.created_at', '>=', now()->subDays(7))
            ->get();
        $totalAvanue =  $totalAvanue[0]->total;

        $increaseTotalAvanue = $this->caculateIncrease($totalAvanue, $totalAvanue2WeeksAgo);

        //caculate total order in table orders with status is 4 in total 14 days ago to 7 days ago

$totalOrderLastMonth = DB::table('orders')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('count(*) as total'))
            ->whereBetween('orders.created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])
            ->where('deleted_at', null)
            ->get();


        $totalOrderLastMonth = $totalOrderLastMonth[0]->total;

        //caculate total order in table orders with status is 4 in total 7 days ago

        $totalOrder = DB::table('orders')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('count(*) as total'))
            ->whereBetween('orders.created_at', [now()->startOfMonth(), now()->addDays(1)])
            ->where('deleted_at', null)
            ->get();

        $totalOrder = $totalOrder[0]->total;
        $increaseTotalOrder = $this->caculateIncrease($totalOrder, $totalOrderLastMonth);

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
               ->whereBetween('created_at', [now()->subDays(7)->format('Y-m-d'), now()->addDays(1)->format('Y-m-d')])
            ->where('deleted_at', null)
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
        $totalOrderData = $this->mapDataWith7DayAgo($totalOrders);
        $formatTotalOrderData = $this->prepareDataForRowChart($totalOrderData);

        $products = Product::get();
        $users = count(User::get());
        return view('admin.dashboard.dashboard-staff', [
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
            'comments' => $totalComment[0]->total,
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


    //get activity data
    public function getActivityData()
    {
        // $activities = Activity::with('admin')->select('*');
        // activities join admin and select all columns in table activities and admin use eloquent
        $activities = Activity::with(['admin'])->select('*');

        return Datatables::eloquent($activities)->addColumn('avatar', function ($activity) {
            return '<img src="' . $activity->admin->avatar . '" width="40" style="border-radius: 50%;" >';
        })->editColumn('created_at', function ($activity) {
            return  '<span style="font-weight: bold;">' . $activity->created_at->format('d.m.Y H:i:s') . '</span>';
        })->rawColumns(['created_at', 'avatar'])->make();
    }

    //get all activity
    public function getAllActivity()
    {
        $activities = Activity::paginate(6);
        return view('admin.activity.list', [
            'title' => 'Danh sách hoạt động',
            'activities' => $activities
        ]);
    }
}
