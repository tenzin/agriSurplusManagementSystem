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
Route::get('login', 'AuthController@loginForm')->name('login');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout')->name('logout');
Route::get('logout', 'AuthController@logout');

Route::get('/', function () {
    return view('index');
});

// Dashboard
Route::group(['middleware' => 'auth'], function () {

Route::get('/national',['as'=>'national','uses'=>'DashboardController@national'])->middleware('can:view_national_dashboard,Auth::user()');
Route::get('/extension',['as'=>'extension','uses'=>'DashboardController@extension'])->middleware('can:view_extension_dashboard,Auth::user()');
Route::get('/aggregator',['as'=>'aggregator','uses'=>'DashboardController@aggregator'])->middleware('can:view_aggregator_dashboard,Auth::user()');

Route::group(['middleware' => 'can:extension_level, Auth::user()'], function() {

//Extension Supply Information Route
Route::get('extension_supply',['as'=>'extension_supply','uses'=>'ExtensionSupplyController@extension_supply'])->middleware('can:extension_add_surplus,Auth::user()');
Route::post('submit_supply_details',['as'=>'submit_supply_details','uses'=>'ExtensionSupplyController@submit_supply_details']);
Route::get('view_supply_details',['as'=>'view_supply_details','uses'=>'ExtensionSupplyController@view_supply_details'])->middleware('can:view_extension_surplus,Auth::user()');

//Extension Under Cultivation
Route::get('extension_cultivation',['as'=>'extension_cultivation','uses'=>'ExtensionUnderCultiavtionController@extension_cultivation'])->middleware('can:extension_add_under_cultivation,Auth::user()');
Route::post('submit_cultivation_details',['as'=>'submit_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@submit_cultivation_details']);
Route::get('view_cultivation_details',['as'=>'view_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@view_cultivation_details'])->middleware('can:extension_view_under_cultivation,Auth::user()');

});

Route::group(['middleware' => 'can:aggregator_level, Auth::user()'], function() {

//Commercial Aggregator Supply Surplus Information Route
Route::get('ca_surplus',['as'=>'ca_surplus','uses'=>'CASurplusController@ca_surplus'])->middleware('can:aggregator_add_surplus,Auth::user()');
Route::post('submit_surplus_detail',['as'=>'submit_surplus_detail','uses'=>'CASurplusController@submit_surplus_detail']);
Route::get('view_surplus_details',['as'=>'view_surplus_details','uses'=>'CASurplusController@view_surplus_details'])->middleware('can:aggregator_view_surplus,Auth::user()');

//Commercial Aggregator Demand Surplus Information Route
Route::get('ca_surplus_demand',['as'=>'ca_surplus_demand','uses'=>'CADemandController@ca_surplus_demand'])->middleware('can:aggregator_demand_surplus,Auth::user()');
Route::post('submit_surplus_demand_detail',['as'=>'submit_surplus_demand_detail','uses'=>'CADemandController@submit_surplus_demand_detail']);
Route::get('view_surplus_demand_details',['as'=>'view_surplus_demand_details','uses'=>'CADemandController@view_surplus_demand_details'])->middleware('can:aggregator_view_demand_surplus,Auth::user()');

//scope filter for Commercial Aggregator Route
Route::get('scopefilter',['as'=>'scopefilter','uses'=>'CAFilterController@scopefilter'])->middleware('can:aggregator_search_surplus,Auth::user()');
Route::get('view_claim',['as'=>'view_claim','uses'=>'CAFilterController@view_claim'])->middleware('can:aggregator_view_search_surplus,Auth::user()');

});

Route::group(['middleware' => 'can:access_control_list, Auth::user()'], function() {

    //Role Route
    Route::get('indexRole',['as'=>'indexRole','uses'=>'AccessControlListController@indexRole']);
    Route::get('addRole',['as'=>'addRole','uses'=>'AccessControlListController@addRole']);
    Route::post('storeRole',['as'=>'storeRole','uses'=>'AccessControlListController@storeRole']);
    Route::get('editRole/{id}',['as'=>'editRole','uses'=>'AccessControlListController@editRole']);
    Route::post('updateRole',['as'=>'updateRole','uses'=>'AccessControlListController@updateRole']);
    Route::get('destroyRole/{id}',['as'=>'destroyRole','uses'=>'AccessControlListController@destroyRole']);
    
    //Permission Route
    Route::get('indexPermission',['as'=>'indexPermission','uses'=>'AccessControlListController@indexPermission']);
    Route::get('addPermission',['as'=>'addPermission','uses'=>'AccessControlListController@addPermission']);
    Route::post('storePermission',['as'=>'storePermission','uses'=>'AccessControlListController@storePermission']);
    Route::post('updatePermission',['as'=>'updatePermission','uses'=>'AccessControlListController@updatePermission']);
    Route::get('editPermission/{id}',['as'=>'editPermission','uses'=>'AccessControlListController@editPermission']);
    Route::get('destroyPermission/{id}',['as'=>'destroyPermission','uses'=>'AccessControlListController@destroyPermission']);
   
    //User Route
    Route::get('system-user',['as'=>'system-user','uses'=>'AccessControlListController@user']);
    Route::get('userview',['as'=>'userview','uses'=>'AccessControlListController@userview']);
    Route::get('adduser',['as'=>'adduser','uses'=>'AccessControlListController@add']);
    Route::post('new-user',['as'=>'new-user','uses'=>'AccessControlListController@insert']);

  }); // end of acl group list


//User profile Route
Route::get('profile',['as'=>'profile','uses'=>'AccessControlListController@userprofile']);
Route::get('system-user',['as'=>'system-user','uses'=>'AccessControlListController@user']);

//user role and permission
Route::get('role',['as'=>'role','uses'=>'AccessControlListController@role']);
Route::get('permission',['as'=>'permission','uses'=>'AccessControlListController@permission']);

//Contact US
Route::get('contact-us',['as'=>'contact-us','uses'=>'ContactUsController@contact']);
});

//Master product type.
Route::get('product-type',['as' => 'product-type','uses'=>'ProductTypeController@producttype']);
Route::post('product-type-store',['as'=>'product-type-store','uses'=>'ProductTypeController@producttypestore']);
Route::get('product-type-list',['as'=>'product-type-list','uses'=>'ProductTypeController@producttypelist']);
Route::get('product-type-edit/{id}',['as'=>'product-type-edit','uses'=>'ProductTypeController@producttypeedit']);
Route::post('product-type-update/{id}',['as'=>'product-type-update','uses'=>'ProductTypeController@producttypeupdate']);

//master product.
Route::get('product',['as'=>'product','uses'=>'ProductController@productlist']);
Route::get('product-create',['as'=>'product-create','uses'=>'ProductController@productcreate']);
Route::post('product-store',['as'=>'product-store','uses'=>'ProductController@productstore']);
Route::get('product-edit/{id}',['as'=>'product-edit','uses'=>'ProductController@productedit']);
Route::post('product-update/{id}',['as'=>'product-update','uses'=>'ProductController@productupdate']);

//master units.
Route::get('units',['as'=>'units','uses'=>'UnitController@units']);
Route::get('unit-create',['as'=>'unit-create','uses'=>'UnitController@unitcreate']);
Route::post('unit-store',['as'=>'unit-store','uses'=>'UnitController@unitstore']);
Route::get('unit-edit/{id}',['as'=>'unit-edit','uses'=>'UnitController@unitedit']);
Route::post('unit-update/{id}',['as'=>'unit-update','uses'=>'UnitController@unitupdate']);

