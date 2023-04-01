<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\WarehouseReceipt;
use App\Models\WarehouseDetail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Supplier;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class WareHouseController extends Controller
{
    public function index()
    {

        return view('admin.warehouse.list', [
            'title' => 'Danh sách phiếu nhập kho',
        ]);
    }

    public function addPage()
    {
        //get current staff
        $user = Session::get('user');
        //get all product with active = 1 and deleted_at = null
        $products = Product::where('active', 1)->whereNull('delete_at')->get();

        //get all supplier with active = 1 and deleted_at = null
        $suppliers = Supplier::get();

        return view('admin.warehouse.add', [
            'title' => 'Thêm phiếu nhập kho',
            'user' => $user,
            'products' => $products,
            'suppliers' => $suppliers,
        ]);
    }

    //add new warehouse receipt
    public function store(Request $request)
    {
        $input = $request->all();
         $this->validate($request, [
          'note' => 'required|min:10',
        ], [
            'note.required' => 'Ghi chú phải có ít nhất 10 ký tự',
            'note.min' => 'Ghi chú phải có ít nhất 10 ký tự',
        ]);

        try {
            DB::beginTransaction();
            $total = 0;
            $dataCreateWarehouse = [];
            $user = Session::get('user');
            $dataCreateWarehouse['staff_id'] = $user->id;
            $dataCreateWarehouse['supplier_id'] = $input['supplier'];
            $dataCreateWarehouse['note'] = $input['note'];
            $dataCreateWarehouse['status'] = 0;
            foreach ($input['group_product'] as $key => $value) {
                $total += $value['price'] * $value['quantity'];
            }
            $dataCreateWarehouse['total'] = $total;
            $warehouseReceipt = WarehouseReceipt::create($dataCreateWarehouse);

            foreach ($input['group_product'] as $key => $value) {
                $dataCreateWarehouseDetail = [];
                $dataCreateWarehouseDetail['receipt_id'] = $warehouseReceipt->id;
                $dataCreateWarehouseDetail['product_id'] = $value['product'];
                $dataCreateWarehouseDetail['quantity'] = $value['quantity'];
                $dataCreateWarehouseDetail['price'] = $value['price'];
                WarehouseDetail::create($dataCreateWarehouseDetail);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Thêm phiếu nhập không thành công');

            return redirect()->back();
        }

        Alert::success('Thành công', 'Thêm phiếu nhập thành công');
        return redirect()->back();
    }

    //create WareHouseDatatable
    public function getData()
    {
        $receipts = WarehouseReceipt::with('admin')->select('*');



        return Datatables::eloquent($receipts)->addColumn('action', function ($receipt) {
            return $receipt->status == 1 ? '<a style="margin-left:15px; " href="/admin/order/detail/' . $receipt->id . '"><i class="fas fa-edit fa-xl"></i></a>' : '
                    <a style="margin-left:5px; margin-right: 2px;" href="/admin/order/detail/' . $receipt->id . '"><i class="fas fa-edit fa-xl"></i></a>
                     <a href="/admin/order/delete/' . $receipt->id . '" onclick="return deleteOrder(event);"<i type="submit" style="color: red;margin-right: 20px;"
                    class="fas fa-trash fa-xl show-alert-delete-box"></i></a>';
        })->addColumn('staff', function (WarehouseReceipt $receipt) {
            return $receipt->admin->name;
        })->editColumn('confirmed_date', function ($receipt) {
            return  '<span style="font-weight: bold;">' . $receipt->confirmed_date . '</span>';
        })->editColumn('created_at', function ($receipt) {
            return  '<span style="font-weight: bold;">' . $receipt->created_at->format('d.m.Y H:i:s') . '</span>';
        })->editColumn('total', function ($receipt) {
            return  '<span style="color:red;font-weight: bold;"> ' . number_format($receipt->total) . ' <span style="text-decoration: underline;">đ</span></span>';
        })->rawColumns(['action', 'staff', 'total', 'created_at', 'confirmed_date'])->make();
    }
}
