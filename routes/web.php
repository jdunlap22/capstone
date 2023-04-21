<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
//wrapped routes with middleware authentication
Route::middleware(['auth'])->group(function () {
Route::resource('items', '\App\Http\Controllers\ItemController');
Route::resource('categories', '\App\Http\Controllers\CategoryController');
Route::resource('products', '\App\Http\Controllers\ProductController');
Route::resource('public', '\App\Http\Controllers\PublicController');

Route::get('/', 'PublicController@index')->name('products.index');
Route::get('/category/{id}', '\App\Http\Controllers\PublicController@showCategory')->name('products.showCategory');
Route::get('/cart', '\App\Http\Controllers\CartController@showCart')->name('cart.showCart');   
Route::delete('/cart/delete/{id}', '\App\Http\Controllers\CartController@delete')->name('cart.delete');
Route::get('/cart/update/{id}', '\App\Http\Controllers\CartController@update')->name('cart.update');
Route::get('/cart/store/{id}', '\App\Http\Controllers\CartController@store')->name('cart.store');
Route::post('/cart/checkOut', '\App\Http\Controllers\CartController@checkOut')->name('cart.checkOut');
Route::get('/cart/thankyou/{id}', '\App\Http\Controllers\CartController@thankYou')->name('thankyou');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
