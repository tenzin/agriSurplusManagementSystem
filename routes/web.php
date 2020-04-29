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

// Route::get('/', function () {
//     return view('master');
// });

Route::get('/',['as'=>'nationaldashboard','uses'=>'DashboardController@national']);
 Route::get('extension',['as'=>'extension','uses'=>'DashboardController@extension']);
Route::get('/aggregator',['as'=>'aggregator','uses'=>'DashboardController@aggregator']);





