<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.category.list', [
            'categories' => $categories,
            'title' => 'Danh sách danh mục'
        ]);
    }

      public function getData()
     {
         $categories = ProductCategory::select(['id','name','description','active']);

         return Datatables::of($categories)->addColumn('action', function ($category) {
             return '<a style="margin-left:30px; margin-right: 7px;" href="/admin/categories/edit/'.$category->id.'"><i class="fas fa-edit fa-xl"></i></a>' ;
         })->editColumn('active', function ($brand) {
             return  $brand->active == 1 ? '<span class="badge bg-success">Kích hoạt</span>' : '<span class="badge bg-danger">Hủy kích hoạt</span>';
         })->rawColumns(['active', 'action'])->make();
     }

     //show edit category
    public function showEdit(ProductCategory $category)
    {
        return view('admin.category.edit', [
            'category' => $category,
            'title' => 'Cập nhật danh mục'
        ]);
    }

    public function update(Request $request, ProductCategory $category)
    {

           $dataUpdate = [
            'name' => $request->name,
            'description' => $request->description,
            'active' => 1,
        ];

        $category->update($dataUpdate);

        Alert::success('Cập nhật thông tin danh mục cấp thành công');
        return redirect()->route('list_category');
    }


}
