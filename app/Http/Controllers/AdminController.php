<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orderNews = Order::where('created_at', '<>', null)->orderBy('created_at', 'DESC')->limit(8)->get();
        $orders = Order::where('created_at', '>=', now()->subWeek())->where('created_at', '<', now())->get();
        $products = Product::get();
        $users = count(User::get());

        return view('admin.dashboard.dashboard', [
            'title' => 'Admin Dashboard',
            'users' => $users,
            'orderNews' => $orderNews,
            'orders' => $orders,
            'products' => $products
        ]);
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
