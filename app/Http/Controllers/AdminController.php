<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

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

    public function changeActive(Request $request, User $user)
    {
        $input = $request->all();
        $user->update(array('active' => $input['active']));

        return redirect()->back();
    }
}
