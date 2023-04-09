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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();