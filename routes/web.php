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
use App\Http\Controllers\BrandController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UploadUserController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\RatingController;

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

        #Brands
        Route::get('/brand/add', [BrandController::class, 'index']);
        Route::post('/brand/add', [BrandController::class, 'storeBrand']);
        Route::get('/brand/list', [BrandController::class, 'getAllBrands'])->name('brands');
        Route::get('/brand/edit/{brand}', [BrandController::class, 'showEdit']);
        Route::post('/brand/edit/{brand}', [BrandController::class, 'update']);
        Route::post('/brand/change-status/{brand}', [BrandController::class, 'changeStatus']);
        Route::post('/brand/delete/{brand}', [BrandController::class, 'delete']);

       #Orders
       Route::get('/order/lists', [MainController::class, 'orders']);
       Route::get('/order/detail/{order}',[MainController::class, 'show']);
       Route::get('/order/generate-pdf/{order}',[MainController::class, 'generatePDF']);
       Route::post('/order/update/{order}',[MainController::class, 'updateOrderStatus']);
       Route::post('/order/delete/{order}', [MainController::class, 'delete']);

       #Discount
       Route::get('/discount/lists', [DiscountController::class, 'index']);
       Route::get('/discount/add', [DiscountController::class, 'add']);
       Route::post('/discount/add', [DiscountController::class, 'store']);
       Route::get('/discount/edit/{discount}', [DiscountController::class, 'showEdit']);
       Route::post('/discount/edit/{discount}', [DiscountController::class, 'update']);
       Route::post('/discount/delete/{discount}', [DiscountController::class, 'delete']);

       #Comments
       Route::get('/comments/lists', [RatingController::class, 'comments']);
       Route::post('/comments/censorship/{comment}', [RatingController::class, 'updateStatus']);
       Route::post('/comments/delete/{comment}', [RatingController::class, 'delete']);
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

Route::get('/auth/google/callback', [LoginController::class, 'handleProviderCallback']);

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
    Route::get('/checkout', [CardController::class, 'checkout'])->name('checkout');

    //filter product
    Route::get('/filter', [ProductController::class, 'filterPage'])->name('product.filter');
    Route::get('filter-product', [ProductController::class, 'filter']);
    Route::get('/load-more', [ProductController::class, 'loadMore']);
    Route::get('/load-product', [ProductController::class, 'loadProduct']);

    //Apply discount
    Route::get('/discount', [ProductController::class, 'applyDiscount']);

    //Payment
    Route::post('/checkout-product', [CardController::class, 'payment']);

    //Order
    Route::get('/order/update-status/{order}',[MainController::class, 'customerUpdateStatus']);

    //Comment
    Route::post('/comment', [RatingController::class, 'add']);
});

Route::prefix('users')->group(function () {
    Route::get('/detail', [MainController::class, 'userDetail']);
    Route::put('/update/{user}', [MainController::class, 'update']);
    Route::get('/order-tracking', [MainController::class, 'trackOrder']);
});

Route::post('/upload/services', [UploadUserController::class, 'store']);
