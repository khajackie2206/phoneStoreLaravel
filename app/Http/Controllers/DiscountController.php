<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::where('created_at','<>',null)->get();

        return view('admin.discount.list', [
            'title' => 'Danh sách brand',
            'vouchers' => $vouchers,
        ]);
    }

    public function add()
    {
        return view('admin.discount.add', [
            'title' => 'Thêm khuyến mãi'
        ]);
    }

    public function getData()
    {
       $discounts = Voucher::select(['id', 'code', 'quantity', 'type_discount','amount', 'start_date','end_date']);

       return Datatables::of($discounts)->addColumn('action', function ($discount) {
        return '
        <a href="/admin/order/detail/'.$discount->id.'" onclick="return myFunction(event);">
                                                            <i class="fas fa-edit fa-xl"></i>
                                                        </a>
                                                        <a href="/admin/order/detail/'.$discount->id.'" onclick="return myFunction(event);">
                                                             <i type="submit" style="color: red;" class="fas fa-trash fa-xl show-alert-delete-box"></i>
                                                        </a>';
    })->editColumn('type_discount', function ($discount) {
        return $discount->type_discount == 'money' ? '<span class="badge bg-success">Giảm theo tiền</span>' : '<span class="badge bg-warning">giảm theo phần trăm</span>';
    })->editColumn('amount', function ($discount) {
        return $discount->type_discount == 'money' ? '<span style="color: red;">'.number_format($discount->amount).'<span style="text-decoration: underline;">đ</span>' : '<span style="color: red;">'.number_format($discount->amount).'%</span>';
    })->rawColumns(['action', 'type_discount', 'amount'])->make();
    }

}

