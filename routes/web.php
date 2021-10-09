<?php

use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

Route::get('login', [\App\Http\Controllers\Backend\LoginController::class, 'login'])->name('login');
Route::post('login', [\App\Http\Controllers\Backend\LoginController::class, 'doLogin']);

Route::get('register',[\App\Http\Controllers\Frontend\UserController::class,'register'])->name('register');
Route::post('register',[\App\Http\Controllers\Frontend\UserController::class,'doRegister']);

Route::get('add/cart/{id}',[\App\Http\Controllers\Frontend\CartController::class,'cart'])->name('add.cart');
Route::get('cart',[\App\Http\Controllers\Frontend\CartController::class,'show'])->name('cart');

Route::middleware('auth')->group(function () {
    //order
    Route::get('checkout',[\App\Http\Controllers\Frontend\CartController::class,'checkout'])->name('checkout');
    Route::post('order',[\App\Http\Controllers\Frontend\CartController::class,'order'])->name('order');

    Route::get('order/{id}',[\App\Http\Controllers\Frontend\CartController::class,'orderShow'])->name('order.show');

    //profile
    Route::get('profile',[\App\Http\Controllers\Frontend\UserController::class,'profile'])->name('user.profile');
    Route::post('profile',[\App\Http\Controllers\Frontend\UserController::class,'updateProfile']);


    Route::get('logout', [\App\Http\Controllers\Backend\LoginController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->group(function () {
        Route::middleware('isAdmin')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
            Route::get('profile', [\App\Http\Controllers\Backend\LoginController::class, 'profile'])->name('profile');
            Route::get('/products', [\App\Http\Controllers\Backend\ProductController::class, 'index'])->name('admin.product');
            Route::get('/products/create', [\App\Http\Controllers\Backend\ProductController::class, 'create'])->name('admin.product.create');
            Route::post('/products/create', [\App\Http\Controllers\Backend\ProductController::class, 'store']);
            Route::get('products/edit/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('admin.product.edit');
            Route::post('products/edit/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'update']);
            Route::get('products/delete/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'delete'])->name('admin.product.delete');

            Route::get('users', [\App\Http\Controllers\Backend\UserController::class, 'index'])->name('admin.user');
            Route::get('users/create', [\App\Http\Controllers\Backend\UserController::class, 'create'])->name('admin.user.create');
            Route::post('users/create', [\App\Http\Controllers\Backend\UserController::class, 'store']);

            //order
            Route::get('orders',[\App\Http\Controllers\Backend\OrderController::class,'index'])->name('admin.order');
            Route::get('orders/{id}',[\App\Http\Controllers\Backend\OrderController::class,'show'])->name('admin.order.show');
            Route::post('orders/{id}',[\App\Http\Controllers\Backend\OrderController::class,'update']);

            Route::get('orders/status/processing',[\App\Http\Controllers\Backend\OrderController::class,'processing'])->name('admin.order.processing');
            Route::get('orders/status/pending',[\App\Http\Controllers\Backend\OrderController::class,'pending'])->name('admin.order.pending');

        });
    });
});



