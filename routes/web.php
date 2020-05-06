<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('/demand','DemandController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/demand_temp', 'DemandController@demand_temp')->name('demand_temp');
Route::get('/json-product_type','DemandController@product_type');
