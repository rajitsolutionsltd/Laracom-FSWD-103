<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BkashPaymentController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home']);

Route::get('/dashboard', function () {
    return view('frontEnd.pages.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('customer/login', [CustomerAuthController::class, 'loginForm'])->name('customer.login');
Route::post('customer/login', [CustomerAuthController::class, 'login']);
Route::post('customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

Route::middleware('auth')->group(function () {
    Route::get('/billing-details', [CheckoutController::class, 'billingDetailForm'])->name('billing-details');
    Route::post('billing/details/store', [CheckoutController::class, 'billingStore'])->name('billing.details.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-orders', [OrderController::class, 'myOrderIndex'])->name('my-orders');
    Route::get('/show-order/{id}', [OrderController::class, 'showOrder'])->name('show-order');
});

require __DIR__ . '/auth.php';

// route for admin
Route::middleware('auth', 'is_admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('backEnd.layouts.masters');
    });

    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::post('product-datasource', [ProductController::class, 'datasource'])->name('product-datasource');
    Route::resource('order', AdminOrderController::class);
    Route::post('order-accept', [AdminOrderController::class, 'acceptOrder'])->name('order.accept');
    Route::get('order-search', [AdminOrderController::class, 'search'])->name('order.search');
    Route::get('view-invoice', [AdminOrderController::class, 'viewInvoice'])->name('order.invoice');
});

Route::post('quick-product-view/{productId}', [HomeController::class, 'productViewModal']);
Route::get('checkout', [HomeController::class, 'checkoutView'])->name('checkout');
Route::post('process-checkout', [HomeController::class, 'processCheckout'])->name('proccess.checkout');

Route::get('order/payment', [HomeController::class, 'paymentIndex'])->name('order.payment');


Route::group(['middleware' => ['auth']], function () {

    // Payment Routes for bKash
    Route::get('/bkash/payment', [BkashPaymentController::class, 'index']);
    Route::get('/bkash/create-payment', [BkashPaymentController::class, 'createPayment'])->name('bkash-create-payment');
    Route::get('/bkash/callback', [BkashPaymentController::class, 'callBack'])->name('bkash-callBack');
});
