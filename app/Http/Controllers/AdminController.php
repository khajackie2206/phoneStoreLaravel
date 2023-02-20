<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            ->groupBy('payments.name')
            ->get();
        //caculate total price in table order_details with table orders with status in table statues is 4 in total 14 days ago to 7 days ago
        $totalAvanue2WeeksAgo = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('sum(order_details.total_price) as total'))
            ->where('orders.status_id',4)
            ->orWhere('orders.payment_id','<>',1)
            ->where('orders.created_at', '>=', now()->subDays(14))
            ->where('orders.created_at', '<', now()->subDays(7))
            ->get();
        $totalAvanue2WeeksAgo = $totalAvanue2WeeksAgo[0]->total;

        //caculate total price in table order_details with table orders with status in table statues is 4 in total 7 days
        $totalAvanue = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('statuses', 'orders.status_id', '=', 'statuses.id')
            ->select(DB::raw('sum(order_details.total_price) as total'))
            ->where('orders.status_id',4)
            ->orWhere('orders.payment_id','<>',1)
            ->where('orders.created_at', '>=', now()->subDays(7))
            ->get();
        $totalAvanue =  $totalAvanue[0]->total;

        $increaseTotalAvanue = $this->caculateIncrease($totalAvanue, $totalAvanue2WeeksAgo);

        // group total_price in table order_details with table orders within 12 days
        $totalPrices = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(DB::raw('sum(order_details.total_price) as total'), DB::raw('DATE(orders.created_at) as date'))
            ->where('orders.status_id',4)
            ->orWhere('orders.payment_id','<>',1)
            ->where('orders.created_at', '>=', now()->subDays(14))
            ->groupBy('date')
            ->get();

        // group total order within 12 days
        $totalOrders = DB::table('orders')
            ->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))
            ->where('created_at', '>=', now()->subDays(14))
            ->groupBy('date')
            ->get();

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
            'summary' => $totalAvanue,
        ]);
    }

    //function caculate increase in total price in 7 days ago
    public function caculateIncrease($totalAvanue, $totalAvanue2WeeksAgo)
    {
        $increase = 0;
        if ($totalAvanue2WeeksAgo == 0) {
            $increase = 0;
        } else {
            $increase = ($totalAvanue - $totalAvanue2WeeksAgo) / $totalAvanue2WeeksAgo * 100;
        }
        return $increase;
    }

    public function getAllUsers()
    {
        $users = DB::table('users')->where('role' ,0)->paginate(6);
        return view('admin.user.list', [
            'title' => 'Danh sách người dùng',
            'users' => $users
        ]);
    }

    public function getData()
     {
         $users = User::where('role', 0)->select(['id','name','email','active', 'avatar','phone']);

         return Datatables::of($users)->addColumn('action', function ($user) {
             return $user->active ==0 ?'<a style="margin-left: 20px;" onclick="return activeUser(event);" href="/admin/users/change-active/'.$user->id.'?active=1"><i class="fa fa-unlock fa-xl"></i></a>'
              : '<a style="margin-left: 20px;" href="/admin/users/change-active/'.$user->id.'?active=0" onclick="return blockUser(event);"><i type="submit" style="color: red;"
                    class="fa fa-lock fa-xl"></i></a>' ;
         })->editColumn('name', function ($user) {
             return ' <span style="font-weight: bold;">'.$user->name.'</span>';
         })->editColumn('avatar', function ($user) {
             return  '<img src="'.$user->avatar.'" width="40" style="border-radius: 50%;" >';
         })->editColumn('active', function ($user) {
             return  $user->active == 1 ? '<span class="badge bg-success">Kích hoạt</span>' : '<span class="badge bg-danger">Bị khóa</span>';
         })->editColumn('email', function ($user) {
             return  '<span style="font-weight: bold;">'.$user->email.'</span>';
         })->editColumn('phone', function ($user) {
             return  '<span style="font-weight: bold;">'.$user->phone.'</span>';
         })->rawColumns(['name', 'avatar', 'active', 'email','phone','action'])->make();
     }


    public function changeActive(Request $request, User $user)
    {
        $input = $request->all();
        $user->update(array('active' => $input['active']));

        return redirect()->back();
    }
}
