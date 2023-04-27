<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;

class DiscountController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::where('deleted_at', '=', null)->get();

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

    //show edit discount
    public function showEdit($id)
    {
        $voucher = Voucher::find($id);

        return view('admin.discount.edit', [
            'title' => 'Sửa khuyến mãi',
            'voucher' => $voucher,
        ]);
    }

    //function to add discount
    public function store(Request $request)
    {
        $request->validate(
            [
                'code' => 'required|unique:vouchers,code',
                'name' => 'required',
                'quantity' => 'required|numeric',
                'amount' => ['required', function ($attribute, $value, $fail) use ($request) {
                    if ($request->type_discount === "percent" && ($value < 0 || $value > 100)) {
                        $fail("Giảm giá phần trăm, giá trị phải từ 0 đến 100.");
                    } elseif ($request->type_discount === "money" && ($value <= 0 || $value > 5000000)) {
                        $fail("Giá trị phải từ 0 đến 5.000.000");
                    }
                }, 'numeric'],
            ],
            [
                'code.required' => 'Vui lòng nhập mã khuyến mãi',
                'code.unique' => 'Mã khuyến mãi đã tồn tại',
                'name.required' => 'Vui lòng nhập tên khuyến mãi',
                'quantity.required' => 'Vui lòng nhập số lượng',
                'quantity.numeric' => 'Số lượng không hợp lệ',
                'amount.required' => 'Vui lòng nhập số tiền',
                'amount.numeric' => 'Số tiền không hợp lệ',
            ]
        );
        $dateRange = $request->date_range;
        $dateRange = explode(' to ', $dateRange);
        $start_date = $dateRange[0];
        $end_date = $dateRange[1];

        $voucher = new Voucher();
        $voucher->code = $request->code;
        $voucher->quantity = $request->quantity;
        $voucher->type_discount = $request->type_discount;
        $voucher->amount = $request->amount;
        $voucher->active = 1;
        $voucher->start_date = $start_date;
        $voucher->end_date = $end_date;
        $voucher->save();

        Alert::success('Thêm mã khuyến mãi thành công');
        return redirect()->route('discounts');
    }

    //function to update discount
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'code' => 'required|unique:vouchers,code,' . $id,
                'name' => 'required',
                'quantity' => 'required|numeric|gt:0',
                'amount' => ['required', function ($attribute, $value, $fail) use ($request) {
                    if ($request->type_discount === "percent" && ($value < 0 || $value > 100)) {
                        $fail("Giảm giá phần trăm, giá trị phải từ 0 đến 100.");
                    } elseif ($request->type_discount === "money" && ($value <= 0 || $value > 5000000)) {
                        $fail("Giá trị phải từ 0 đến 5.000.000");
                    }
                }, 'numeric'],
            ],
            [
                'code.required' => 'Vui lòng nhập mã khuyến mãi',
                'code.unique' => 'Mã khuyến mãi đã tồn tại',
                'name.required' => 'Vui lòng nhập tên khuyến mãi',
                'quantity.required' => 'Vui lòng nhập số lượng',
                'quantity.numeric' => 'Số lượng không hợp lệ',
                'quantity.gt' => 'Số lượng phải lớn hơn 0',
                'amount.required' => 'Vui lòng nhập số tiền',
                'amount.numeric' => 'Số tiền không hợp lệ',
            ]
        );

        $dateRange = $request->date_range;
        $dateRange = explode(' to ', $dateRange);
        $start_date = $dateRange[0];
        $end_date = $dateRange[1];
        $voucher = Voucher::find($id);
        $voucher->name = $request->name;
        $voucher->code = $request->code;
        $voucher->quantity = $request->quantity;
        $voucher->type_discount = $request->type_discount;
        $voucher->amount = $request->amount;
        $voucher->active = 1;
        $voucher->start_date = $start_date;
        $voucher->end_date = $end_date;
        $voucher->save();

        Alert::success('Cập nhật mã khuyến mãi thành công');
        return redirect()->route('discounts');
    }

    //function to delete discount
    public function delete($id)
    {
        //add datetime to deleted_at column
        DB::table('vouchers')->where('id', $id)->update(['deleted_at' => now()]);

        Alert::success('Xóa mã khuyến mãi thành công');
        return redirect()->route('discounts');
    }


    public function getData()
    {
        $discounts = Voucher::select(['id', 'code', 'quantity', 'type_discount', 'amount', 'active', 'start_date', 'end_date'])->where('deleted_at', null);

        return Datatables::of($discounts)->addColumn('action', function ($discount) {
            return '
        <a href="/admin/discount/edit/' . $discount->id . '">
                                                            <i class="fas fa-edit fa-xl"></i>
                                                        </a>
                                                        <a href="/admin/discount/delete/' . $discount->id . '" onclick="return deleteDiscount(event);">
                                                             <i type="submit" style="color: red;" class="fas fa-trash fa-xl show-alert-delete-box"></i>
                                                        </a>';
        })->editColumn('type_discount', function ($discount) {
            return $discount->type_discount == 'money' ? '<span class="badge bg-success">Giảm theo tiền</span>' : '<span class="badge bg-warning">giảm theo phần trăm</span>';
        })->editColumn('active', function ($discount) {
            //get current datetime
            $now = Carbon::now()->format('Y-m-d H:i');

            return $discount->start_date > $now ? '<span class="badge bg-warning">Sắp diễn ra</span>' : ($discount->end_date < $now ? '<span class="badge bg-danger">Hết hạn</span>' : '<span class="badge bg-success">Đang diễn ra</span>');
        })->editColumn('amount', function ($discount) {
            return $discount->type_discount == 'money' ? '<span style="color: red;">' . number_format($discount->amount) . '<span style="text-decoration: underline;">đ</span>' : '<span style="color: red;">' .  number_format($discount->amount, 2, '.', '') . '%</span>';
        })->rawColumns(['action', 'type_discount', 'amount', 'active'])->make();
    }
}
