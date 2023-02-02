<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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


Route::get('/',[ProductController::class,'index'])->name('home');

Route::view('/Register','Register');
Route::post('/save_user',[Usercontroller::class,'save_user']);

Route::view('/login',"login")->name('login');
Route::post('/user_login',[Usercontroller::class,'user_login'])->name('user_login');

   //FORGOT PASSWORD
Route::get('/forget', [UserController::class, 'forgetPass'])->name('forget');
Route::post('/newpass', [UserController::class, 'newpass'])->name('newpass');
Route::get('/password-reset/{token}', [UserController::class, 'passwordReset'])->name('password-reset');
Route::post('/resetpassword', [UserController::class, 'reset'])->name('reset-password');
  
Route::get('/search_product',[ProductController::class,'search']);

Route::get('detail/{id}',[ProductController::class,'detail']);
Route::post('/add_to_cart',[ProductController::class,'addtocart']);
Route::post('/add_to_buy',[ProductController::class,'addtobuy']);
Route::get('/cartlist',[ProductController::class,'cartList']);
Route::get('removecart/{id}',[ProductController::class,'removeCart']);
Route::get('/ordernow',[ProductController::class,'buynow']);
Route::post('/orderplaced',[ProductController::class,'orderplaced'])->name('orderplaced');
Route::get('/myorders',[ProductController::class,'myOrders']);

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});

Route::view('/repwd','Resetpwd');
