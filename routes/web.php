<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UploadUserController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WareHouseController;

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

Route::prefix('admin')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/home', [AdminController::class, 'index']);

        Route::middleware(['block.staff'])->group(function () {
            Route::get('/dashboard-staff', [StaffController::class, 'index']);

            #Orders
            Route::get('/order/lists', [MainController::class, 'orders']);
            Route::get('/order/lists/order-lists', [MainController::class, 'getData'])->name('order_data');
            Route::get('/order/detail/{order}', [MainController::class, 'show']);
            Route::get('/order/generate-pdf/{order}', [MainController::class, 'generatePDF']);
            Route::get('/order/generate-order-pdf', [MainController::class, 'generateOrderPDF']);
            Route::get('/order/export-excel', [MainController::class, 'exportExcel']);
            Route::get('/order/export-csv', [MainController::class, 'exportCSV']);
            Route::post('/order/update/{order}', [MainController::class, 'updateOrderStatus']);
            Route::get('/order/delete/{order}', [MainController::class, 'delete']);

            #Comments
            Route::get('/comments/lists', [RatingController::class, 'comments']);
            Route::get('/comments/censorship/{comment}', [RatingController::class, 'updateStatus']);
            Route::get('/comments/delete/{comment}', [RatingController::class, 'delete']);
            Route::get('/comments/getdata', [RatingController::class, 'getData'])->name('rating_data');

            #Product
            Route::get('/product/add', [ProductController::class, 'index']);
            Route::post('/product/add', [ProductController::class, 'storeProduct']);
            Route::get('/product/list', [ProductController::class, 'getAllProducts'])->name('product_list');
            Route::get('/product/edit/{product}', [ProductController::class, 'showEdit']);
            Route::post('/product/edit/{product}', [ProductController::class, 'update']);
            Route::get('/product/delete/{product}', [ProductController::class, 'delete']);
            Route::get('/product/list/product-data', [ProductController::class, 'getData'])->name('product_data');

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
            Route::get('/banner/data', [BannerController::class, 'getData'])->name('banner_data');

            #users
            Route::get('/users', [AdminController::class, 'getAllUsers']);
            Route::get('/users/change-active/{user}', [AdminController::class, 'changeActive']);
            Route::get('/users/user-data', [AdminController::class, 'getData'])->name('user_data');
            Route::get('/change-info/{admin}', [AdminController::class, 'getDetail']);
            Route::put('/change-info/{admin}', [AdminController::class, 'changeInfo']);
            Route::get('/change-password/{admin}', [AdminController::class, 'changePasswordPage']);
            Route::post('/change-password/{admin}', [AdminController::class, 'changePassword']);

            #Warehouse
            Route::get('/warehouses', [WareHouseController::class, 'index'])->name('warehouses');
            Route::get('/warehouses/add', [WareHouseController::class, 'addPage']);
            Route::post('/warehouses/add', [WareHouseController::class, 'store']);
            Route::get('/warehouses/edit/{warehouse_receipt}', [WareHouseController::class, 'showEdit']);
            Route::get('/warehouses/change-status/{warehouse_receipt}', [WareHouseController::class, 'update']);
            Route::get('/warehouses/delete/{warehouse_receipt}', [WareHouseController::class, 'delete']);
            Route::get('/warehouses/getdata', [WareHouseController::class, 'getData'])->name('warehouse_data');
            Route::get('/warehouses/export-pdf/{warehouse_receipt}', [WareHouseController::class, 'generateWarehousePDF']);
            Route::get('/warehouses/export-excel', [WareHouseController::class, 'exportWarehouseReceiptExcel']);
            Route::get('/warehouses/export-csv', [WareHouseController::class, 'exportWarehouseReceiptCSV']);
            Route::get('/warehouses/generate-receipt-pdf', [WareHouseController::class, 'generateListWarehousePDF']);

            #suppliers
            Route::get('/suppliers', [SupplierController::class, 'index'])->name('list_suppliers');
            Route::get('/suppliers/add', [SupplierController::class, 'addPage']);
            Route::post('/suppliers/add', [SupplierController::class, 'store']);
            Route::get('/suppliers/edit/{supplier}', [SupplierController::class, 'showEdit']);
            Route::get('/suppliers/supplier-data', [SupplierController::class, 'getData'])->name('supplier_data');
            Route::post('/suppliers/edit/{supplier}', [SupplierController::class, 'update']);
        });

        Route::middleware(['role'])->group(function () {
            #Brands
            Route::get('/brand/add', [BrandController::class, 'index']);
            Route::post('/brand/add', [BrandController::class, 'storeBrand']);
            Route::get('/brand/list', [BrandController::class, 'getAllBrands'])->name('brands');
            Route::get('/brand/edit/{brand}', [BrandController::class, 'showEdit']);
            Route::post('/brand/edit/{brand}', [BrandController::class, 'update']);
            Route::post('/brand/change-status/{brand}', [BrandController::class, 'changeStatus']);
            Route::get('/brand/delete/{brand}', [BrandController::class, 'delete']);
            Route::get('/brand/list/data', [BrandController::class, 'getData'])->name('brand_data');

            #Discount
            Route::get('/discount/lists', [DiscountController::class, 'index'])->name('discounts');
            Route::get('/discount/add', [DiscountController::class, 'add']);
            Route::post('/discount/add', [DiscountController::class, 'store']);
            Route::get('/discount/edit/{discount}', [DiscountController::class, 'showEdit']);
            Route::post('/discount/edit/{discount}', [DiscountController::class, 'update']);
            Route::get('/discount/delete/{discount}', [DiscountController::class, 'delete']);
            Route::get('/discount/getdata', [DiscountController::class, 'getData'])->name('discount_data');

            #staffs
            Route::get('/staffs', [AdminController::class, 'getAllStaff']);
            Route::get('/staffs/change-active/{admin}', [AdminController::class, 'changeStaffActive']);
            Route::get('/staffs/staff-data', [AdminController::class, 'getstaffData'])->name('staff_data');
            Route::get('/staffs/delete/{admin}', [AdminController::class, 'deleteStaff']);
            Route::post('/staffs/add', [AdminController::class, 'createStaff']);
            Route::get('/staffs/add', [AdminController::class, 'createStaffPage']);

            #category
            Route::get('/categories/list', [CategoryController::class, 'index'])->name('list_category');
            Route::get('/categories/edit/{category}', [CategoryController::class, 'showEdit']);
            Route::get('/categories/supplier-data', [CategoryController::class, 'getData'])->name('category_data');
            Route::post('/categories/edit/{category}', [CategoryController::class, 'update']);

            #activities
            Route::get('/activities', [StaffController::class, 'getAllActivity']);
            Route::GET('/activity-data', [StaffController::class, 'getActivityData'])->name('activity_data');

            #filter revenue
            Route::post('/filter-revenue', [AdminController::class, 'filterRevenue']);
            Route::post('/filter-time', [AdminController::class, 'filterTime']);
        });
    });

Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('login');
Route::get('/admin/logout', [AdminLoginController::class, 'getLogout']);
Route::post('/admin/login', [AdminLoginController::class, 'postLogin']);
Route::get('/', [MainController::class, 'index'])->name('index');
Route::post('/login', [LoginController::class, 'postLogin'])->name('user-login');
Route::get('/register', [LoginController::class, 'registerPage'])->name('register');
Route::post('/register', [RegisterController::class, 'create']);
Route::get('/logout', [LoginController::class, 'getLogout']);
Route::get('/login', [LoginController::class, 'index']);

#Login with google
Route::get('google', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [LoginController::class, 'handleProviderCallback']);

#product of user portal
Route::middleware(['block'])->group(function () {
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
        Route::post('/checkout-product/vnpay', [CardController::class, 'paymentWithVNpay']);
        Route::get('/payment-success', [CardController::class, 'PaymentSuccess'])->name('paymentsuccess');
        Route::get('/payment-cancel', [CardController::class, 'PaymentCancel'])->name('paymentCancel');
        Route::get('/handle-vnpay', [CardController::class, 'payment']);

        // Checkout Sevive
        Route::post('/process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
        Route::get('/success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
        Route::get('/cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
        Route::get('/thank-you', [CardController::class, 'thankYou'])->name('thank-you');;

        //Order
        Route::get('/order/update-status/{order}', [MainController::class, 'customerUpdateStatus']);

        //Comment
        Route::post('/comment', [RatingController::class, 'add']);
    });
});

Route::middleware(['block'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/detail', [MainController::class, 'userDetail']);
        Route::put('/update/{user}', [MainController::class, 'update']);
        Route::get('/order-tracking', [MainController::class, 'trackOrder']);

        //Change password
        Route::get('/change-password', [MainController::class, 'changePasswordPage']);
        Route::post('/change-password/{user}', [MainController::class, 'changePassword']);

        // forget password
        Route::get('forget-password', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        Route::post('forget-password', [ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        Route::get('reset-password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    });
});


Route::post('/upload/services', [UploadUserController::class, 'store']);
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
Route::get('account/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');
