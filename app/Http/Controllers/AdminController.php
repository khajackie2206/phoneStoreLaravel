<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.dashboard.dashboard', [
            'title' => 'Admin Dashboard'
        ]);
    }

    public function getAllUsers()
    {
        $users = DB::table('users')->paginate(6);
        return view('admin.user.list', [
            'title' => 'Danh sách người dùng',
            'users' => $users
        ]);
    }

    public function changeActive(Request $request, User $user)
    {
        $input = $request->all();
        $user->update(array('active' => $input['active']));

        Alert::success('Thành công', 'Đã cập nhật tài khoản ' . $user->email . '');
        return redirect()->to('/admin/users');
    }
}
