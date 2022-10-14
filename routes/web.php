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
use App\Http\Controllers\BannerController;
use App\Http\Controllers\GoogleController;

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

Route::prefix('admin')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::get('/home', [AdminController::class, 'index']);

        #Product
        Route::get('/product/add', [ProductController::class, 'index']);
        Route::post('/product/add', [ProductController::class, 'storeProduct']);
        Route::get('/product/list', [ProductController::class, 'getAllProducts']);
        Route::get('/product/edit/{product}', [ProductController::class, 'showEdit']);
        Route::post('/product/edit/{product}', [ProductController::class, 'update']);
        Route::get('/product/delete/{product}', [ProductController::class, 'delete']);

        #Upload
        Route::post('/upload/services', [UploadController::class, 'store']);
        Route::post('/multi-upload/services', [UploadController::class, 'multiStore']);

        #Banner
        Route::get('/banner/add', [BannerController::class, 'index']);
        Route::post('/banner/add', [BannerController::class, 'storeBanner']);
        Route::get('/banner/list', [BannerController::class, 'getAllBanners'])->name('banners');
        Route::get('/banner/edit/{banner}', [BannerController::class, 'showEdit']);
        Route::post('/banner/edit/{banner}', [BannerController::class, 'update']);
        Route::get('/banner/delete/{banner}', [BannerController::class, 'delete']);

        #users
        Route::get('/users', [AdminController::class, 'getAllUsers']);
        Route::post('/users/change-active/{user}', [AdminController::class, 'changeActive']);
    });
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('login');
Route::get('/admin/logout', [AdminLoginController::class, 'getLogout']);
Route::post('/admin/login', [AdminLoginController::class, 'postLogin']);
Route::get('/', [MainController::class, 'index'])->name('index');
Route::post('/login', [LoginController::class, 'postLogin']);
Route::get('/register', [LoginController::class, 'registerPage'])->name('register');
Route::post('/register', [RegisterController::class, 'create']);
Route::get('/logout', [LoginController::class, 'getLogout']);
Route::get('/login', [LoginController::class, 'index']);

#Login with google
Route::get('google', [LoginController::class, 'redirectToProvider']);

Route::get('/auth/google/callback',[LoginController::class, 'handleProviderCallback']);

#product of user portal
Route::prefix('products')->group(function () {
    Route::get('/detail/{id}', [ProductController::class, 'getProductDetail']);
    Route::get('/details/{id}', [ProductController::class, 'detail']);
    Route::get('/live-search', [ProductController::class, 'search']);
    Route::post('/cart', [CardController::class, 'addCart']);
    Route::get('/carts', [CardController::class, 'showCard'])->name('carts');
    Route::get('/delete-cart/{id}', [CardController::class, 'delete']);

    //payment
    Route::get('/update/{id}', [CardController::class, 'update']);
    Route::get('/adjust/{id}', [CardController::class, 'adjust']);
    Route::get('/checkout', [CardController::class, 'checkout']);

    //filter product
    Route::get('/filter', [ProductController::class, 'filterPage']);
    Route::get('filter-product', [ProductController::class, 'filter']);
    Route::get('/load-more', [ProductController::class, 'loadMore']);
    Route::get('/load-product', [ProductController::class, 'loadProduct']);
});

