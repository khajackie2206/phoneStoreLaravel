<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class DiscountController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::where('created_at','<>',null)->Paginate(8);

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
}
