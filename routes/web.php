<?php

use App\Http\Controllers\admin\Attribute_Value;
use App\Http\Controllers\admin\AttributeController;
use App\Http\Controllers\admin\BlockController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\EnquiryController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

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


Route::get("admin", [LoginController::class, "index"])->name("login");
Route::post("admin/login-post", [LoginController::class, "loginPost"])->name("login-post");


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::post('store', [EnquiryController::class, 'store'])->name('store');


Route::group(["prefix" => "admin", "middleware" => "auth"], function () {
    Route::get("signout", [LoginController::class, "signOut"])->name("signout");
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('block', BlockController::class);
    Route::resource('page', PageController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('attribute', AttributeController::class);
    Route::resource('attribute_value', Attribute_Value::class);
    Route::resource('coupon', CouponController::class);

    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/show{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('order/invoice/{id}', [OrderController::class, 'generateInvoice'])->name('order.invoice');

    Route::get('enquiry', [EnquiryController::class, 'index'])->name('enquiry');
    Route::get('enquiry-status/{id}', [EnquiryController::class, 'status'])->name('enquiry-status');
    Route::delete('enquiry-destroy/{id}', [EnquiryController::class, 'destroy'])->name('enquiry-destroy');
});

Route::get('cart', [CartController::class, 'viewCart'])->name('cart');
Route::post('cart/store/{id}', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('cart/update/{id}', [CartController::class, 'cartUpdate'])->name('cart.update');
Route::delete('cart/delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');

Route::post('coupon/apply{id}', [CartController::class, 'couponApply'])->name('coupon.apply');

Route::get('checkout', [CheckoutController::class, 'checkOut'])->name('checkout');
Route::post('checkout/store', [CheckoutController::class, 'CheckoutPlaceOrderStore'])->name('checkout.store');
Route::get('makePayment', [CheckoutController::class, 'makePayment'])->name('make.payment');

Route::get('customer/register', [CustomerController::class, 'create'])->name('customer.create');
Route::post('customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::get('customer/login', [CustomerController::class, 'custemerLogin'])->name('customer.login');
Route::post('customer/authenticate', [CustomerController::class, 'login'])->name('customer.authenticate');
Route::get('customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');
Route::get('customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
Route::post('customer/update', [CustomerController::class, 'update'])->name('customer.update');
Route::get('customer/product/show/{id}', [CustomerController::class, 'customerProductShow'])->name('customer.product.show');

Route::post('wishlist/store', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('wishlist/delete{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

Route::get('/{urlkey}', [HomeController::class, 'page'])->name('page');
Route::get('category/{urlkey}', [HomeController::class, 'category'])->name('category');
Route::get('product/{urlkey}', [HomeController::class, 'product'])->name('product');
// Route::get('/', function () {
//     return view('welcome');
// });
