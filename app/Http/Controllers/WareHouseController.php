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
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WarehouseReceiptExport;
use App\Models\Activity;
use Carbon\Carbon;

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
        $suppliers = Supplier::where('status', 1)->get();

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

            $user = session()->get('user');
            $activityData = array(
                'staff_id' => $user->id,
                'action' => 'Thêm phiếu nhập mới (Mã phiếu nhập: #' . $warehouseReceipt->id . ')'
            );

            $activityData = Activity::create($activityData);

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
            $user = Session::get('user');

            return $receipt->status != 1 && $user->role == 1  ? '
                    <a style="margin-left:5px; margin-right: 2px;" href="/admin/warehouses/edit/' . $receipt->id . '"><i class="fas fa-edit fa-xl"></i></a>
                     <a href="/admin/warehouses/delete/' . $receipt->id . '" onclick="return deleteWarehouse(event);"<i type="submit" style="color: red;margin-right: 20px;"
                    class="fas fa-trash fa-xl show-alert-delete-box"></i></a>' : '<a style="margin-left:15px; " href="/admin/warehouses/edit/' . $receipt->id . '"><i class="fas fa-edit fa-xl"></i></a>';
        })->addColumn('staff', function (WarehouseReceipt $receipt) {
            return $receipt->admin->name;
        })->editColumn('confirmed_date', function ($receipt) {
            return  $receipt->confirmed_date == null ? '<span style="font-style: italic;">*Chưa duyệt*</span>' :'<span style="font-weight: bold;">' . $receipt->confirmed_date . '</span>';
        })->editColumn('created_at', function ($receipt) {
            return  '<span style="font-weight: bold;">' . $receipt->created_at->format('d.m.Y H:i:s') . '</span>';
        })->editColumn('total', function ($receipt) {
            return  '<span style="color:red;font-weight: bold;"> ' . number_format($receipt->total) . ' <span style="text-decoration: underline;">đ</span></span>';
        })->rawColumns(['action', 'staff', 'total', 'created_at', 'confirmed_date'])->make();
    }

    //showEdit warehouse receipt
    public function showEdit(WarehouseReceipt $warehouseReceipt)
    {
        //get current staff
        $user = Session::get('user');
        return view('admin.warehouse.detail', [
            'title' => 'Chi tiết phiếu nhập kho',
            'warehouse' => $warehouseReceipt,
            'user' => $user,
        ]);
    }

    //update status of warehouse
    public function update(Request $request, WarehouseReceipt $warehouseReceipt)
    {
        $input = $request->all();
        if ($input['status'] == 1) {
            foreach ($warehouseReceipt->warehouseDetails()->get() as $key => $value) {
                $product = Product::find($value->product_id);
                $product->quantity += $value->quantity;
                $product->save();
            }
            $warehouseReceipt->status = 1;
            $warehouseReceipt->confirmed_date = Carbon::now();
            $warehouseReceipt->save();
            //increase quantity of product

            Alert::success('Đã xác nhận nhập kho');
            return redirect()->back();
        }

        $warehouseReceipt->status = 0;
        $warehouseReceipt->save();
        Alert::error('Đã từ chối nhập kho');

        return redirect()->back();
    }

    public function generateWarehousePDF(WarehouseReceipt $warehouseReceipt)
    {

        $user = session()->get('user');
        // get time now with format Y-m-d H:i:s
        $time = Carbon::now()->format('d-m-Y H:i:s');

        $data = [
            'title' => 'Chi tiết phiếu nhập',
            'warehouse' => $warehouseReceipt,
            'user' => $user,
            'time' => $time
        ];

        $pdf = Pdf::loadView('pdf.generateWarehouseDetail', $data);
        $pdf->set_option('isRemoteEnabled', true);
        $pdf->render();

        return $pdf->stream('phieunhap.pdf')->header('Content-Type', 'application/pdf');
    }

    public function exportWarehouseReceiptCSV()
    {
        $file_name = 'receipts_' . date('Y_m_d_H_i_s') . '.csv';

        return Excel::download(new WarehouseReceiptExport, $file_name);
    }

    public function exportWarehouseReceiptExcel()
    {
        $file_name = 'receipts_' . date('Y_m_d_H_i_s') . '.xlsx';

        return Excel::download(new WarehouseReceiptExport, $file_name);
    }

    public function generateListWarehousePDF()
    {
        $warehouseReceipts = WarehouseReceipt::all();
        //get user data from session
        $user = session()->get('user');
        // get time now with format Y-m-d H:i:s
        $time = Carbon::now()->format('Y-m-d H:i:s');
        $data = [
            'title' => 'Danh sách đơn hàng',
            'warehouseReceipts' => $warehouseReceipts,
            'user' => $user,
            'time' => $time
        ];

        $pdf = Pdf::loadView('pdf.generateWarehouseListPDF', $data);
        $pdf->set_option('isRemoteEnabled', true);
        $pdf->render();

        return $pdf->stream('listOrder.pdf')->header('Content-Type', 'application/pdf');;
    }

    //delete warehouse receipt
    public function delete(WarehouseReceipt $warehouseReceipt)
    {
        $warehouseReceipt->delete();
        Alert::success('Đã xóa phiếu nhập kho');

        return redirect()->back();
    }
}
