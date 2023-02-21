<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class DiscountController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::where('created_at','<>',null)->get()->toArray();
        //loop through $vouchers
        //init result string
        $vouchersStr = [];
        foreach ($vouchers as $key => $value) {
            //get array_values of $value but keep double quote
            $value = array_map(function($v) {
                return '"' . $v . '"';
            }, array_values($value));
            array_push($vouchersStr, implode(',', array_values($value)));
        }
        //merge all value of $vouchersStr to one string and wrap value to []
        $vouchersStr = '[' . implode('],[', $vouchersStr) . ']';
        // dd($vouchersStr);
        return view('admin.discount.list', [
            'title' => 'Danh sách brand',
            'vouchers' =>$vouchersStr,
        ]);
    }

    public function add()
    {
        return view('admin.discount.add', [
            'title' => 'Thêm khuyến mãi'
        ]);
    }
}
