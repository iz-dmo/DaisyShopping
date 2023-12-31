<?php

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
Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);

Route::resource('/item',App\Http\Controllers\ItemController::class);
Route::get('/item/categories/{id}',[App\Http\Controllers\ItemController::class,'itemCategory'])->name('itemcategory');
Route::get('/cart',[App\Http\Controllers\ItemController::class, 'cartTable'])->name('itemTable');

Route::post('orders',[App\Http\Controllers\ItemController::class, 'orderNow'])->name('orderNow');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth'],'prefix'=>'backend','as'=>'backend.'],function(){
    Route::get('/',[App\Http\Controllers\Admin\DashBoardController::class,'index'])->name('dashboard');
    Route::resource('items',App\Http\Controllers\Admin\ItemController::class);
    Route::resource('categories',App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('payments',App\Http\Controllers\Admin\PaymentController::class);
    Route::resource('users',App\Http\Controllers\Admin\UserController::class);

    Route::get('orders',[App\Http\Controllers\Admin\OrderController::class,'index'])->name('orders.index');
    Route::get('orders/{voucherNo}',[App\Http\Controllers\Admin\OrderController::class,'detail'])->name('orders.detail');
    Route::put('orders/{voucherNo}',[App\Http\Controllers\Admin\OrderController::class,'status'])->name('orders.status');
    // Route::get('orderAccept',[App\Http\Controllers\Admin\OrderController::class,'orderAccept'])->name('orders.orderAccept');


});