<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class SupplierController extends Controller
{

    // create index function
    public function index()
    {
        return view('admin.supplier.list', [
            'title' => 'Danh sách nhà cung cấp',
        ]);
    }

    // create function to get data from database
    public function getData()
    {
        $supplier = Supplier::all();
        return DataTables::of($supplier)
            ->addColumn('action', function ($supplier) {
                return '<a style="margin-left:15px; " href="/admin/suppliers/edit/' . $supplier->id . '" ><i class="fas fa-edit fa-xl"></i></a>';
            })->editColumn('status', function ($supplier) {
                return  $supplier->status == 1 ? '<span class="badge bg-success">Đang hợp tác</span>' : '<span class="badge bg-danger">Ngừng hợp tác</span>';
            })->editColumn('name', function ($supplier) {
                return  '<span style="font-weight: bold;"> '.$supplier->name.'</span>';
            })->rawColumns(['action','status', 'name'])
            ->make(true);
    }

    // create function to create new supplier
    public function addPage()
    {
        return view('admin.supplier.add' ,[ 'title' => 'Thêm nhà cung cấp']);
    }

    // update supplier info
    public function store(Request $request)
    {
        // validate data with message
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|min:10|numeric',
            'email' => 'required|email',
            'status' => 'required',
        ], [
            'name.required' => 'Tên nhà cung cấp không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.min' => 'Số điện thoại không được nhỏ hơn 10 số',
            'phone.numeric' => 'Số điện thoại không hợp lệ',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'status.required' => 'Trạng thái không được để trống',
        ]);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->status = $request->status;
        $supplier->save();
        Alert::success('Thêm nhà cung cấp thành công');
        return redirect()->back();
    }

    // create function to edit supplier info
    public function showEdit(Supplier $supplier)
    {
        return view('admin.supplier.detail', [
            'title' => 'Cập nhật nhà cung cấp',
            'supplier' => $supplier,
        ]);
    }

    // update supplier info
    public function update(Request $request, Supplier $supplier)
    {
        // validate data with message
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|min:10|numeric',
            'email' => 'required|email',
        ], [
            'name.required' => 'Tên nhà cung cấp không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.min' => 'Số điện thoại không được nhỏ hơn 10 số',
            'phone.numeric' => 'Số điện thoại không hợp lệ',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
        ]);
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->status = $request->status;
        $supplier->save();
        Alert::success('Cập nhật thông tin nhà cung cấp thành công');
        return redirect()->back();
    }
}
