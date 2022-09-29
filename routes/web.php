<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\RegisterController;

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

     #Product
      Route::get('/product/add', [ProductController::class,'index']);
      Route::post('/product/add', [ProductController::class, 'storeProduct']);
      Route::get('/product/list',[ProductController::class, 'getAllProducts']);
      Route::get('/product/edit/{product}',[ProductController::class, 'showEdit']);
      Route::get('/product/edit/{product}',[ProductController::class, 'showEdit']);
      Route::post('/product/edit/{product}',[ProductController::class, 'update']);
      Route::post('/product/edit/{product}',[ProductController::class, 'update']);
      Route::get('/product/delete/{product}',[ProductController::class, 'delete']);

      #Upload
      Route::post('/upload/services',[UploadController::class,'store']);
      Route::post('/multi-upload/services',[UploadController::class,'multiStore']);

      
});
Route::get('/admin/login',[AdminLoginController::class,'index'])->name('login');
Route::get('/admin/logout',[AdminLoginController::class,'getLogout']);
Route::post('/admin/login',[AdminLoginController::class,'postLogin']);
Route::get('/', [MainController::class, 'index'])->name('index');
Route::post('/login', [LoginController::class, 'postLogin']);
Route::get('/register', [LoginController::class, 'index']);
Route::post('/register', [RegisterController::class,'create']);
Route::get('/logout', [LoginController::class, 'getLogout']);
Route::get('/login', [LoginController::class, 'index']);

#product of user portal
Route::prefix('products')->group(function(){
    Route::get('/detail/{id}', [ProductController::class, 'getProductDetail']);
    Route::get('/details/{id}', [ProductController::class, 'detail']);
    Route::get('/live-search', [ProductController::class,'search']);
    Route::post('/cart', [CardController::class,'addCart']);
    Route::get('/carts', [CardController::class,'showCard'])->name('carts');
    Route::get('/delete-cart/{id}', [CardController::class, 'delete']);
    
    Route::get('/update/{id}', [CardController::class, 'update']);
    Route::get('/adjust/{id}', [CardController::class, 'adjust']);
    Route::get('/checkout', [CardController::class, 'checkout']);
});






   