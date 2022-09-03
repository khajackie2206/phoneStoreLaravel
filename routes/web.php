<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/home', [AdminController::class,'index']);
    Route::get('/product/add', [ProductController::class,'index']);
    Route::post('/product/add', [ProductController::class, 'storeProduct']);

      #Upload
      Route::post('/upload/services',[UploadController::class,'store']);
      Route::post('/multi-upload/services',[UploadController::class,'multiStore']);
});
Route::get('/admin/login',[AdminLoginController::class,'index'])->name('login');
Route::get('/admin/logout',[AdminLoginController::class,'getLogout']);
Route::post('/admin/login',[AdminLoginController::class,'postLogin']);
Route::get('/', [MainController::class, 'index']);
Route::post('/login', [LoginController::class, 'postLogin']);
Route::get('/login', [LoginController::class, 'index']);





   