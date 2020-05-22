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
//Login Route
Route::get('login', 'AuthController@loginForm')->name('login');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout')->name('logout');
Route::get('logout', 'AuthController@logout');

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/','MapController@index');

// Dashboard
Route::group(['middleware' => 'auth'], function () {

      Route::get('/national',['as'=>'national','uses'=>'DashboardController@national'])->middleware('can:view_national_dashboard,Auth::user()');
      Route::get('/extension',['as'=>'extension','uses'=>'DashboardController@extension'])->middleware('can:view_extension_dashboard,Auth::user()');
      Route::get('/aggregator',['as'=>'aggregator','uses'=>'DashboardController@aggregator'])->middleware('can:view_aggregator_dashboard,Auth::user()');
      Route::post('/search-surplus',['as'=>'search-surplus','uses'=>'DashboardController@aggregator'])->middleware('can:view_aggregator_dashboard,Auth::user()');


Route::group(['middleware' => 'can:extension_level, Auth::user()'], function() {


      //Extension Supply Information Route
      Route::get('ex-day',['as'=>'ex-day','uses'=>'ExtensionSupplyController@ex_expiryday'])->middleware('can:extension_add_surplus,Auth::user()');
      Route::post('ex-store',['as'=>'ex-store','uses'=>'ExtensionSupplyController@ex_store_transaction']);
      Route::get('surplus-view',['as'=>'surplus-view','uses'=>'ExtensionSupplyController@ex_store_transaction']);
      Route::post('ex-supply-store',['as'=>'ex-supply-store','uses'=>'ExtensionSupplyController@ex_store']);
      Route::get('ex-supply-edit/{id}',['as'=>'ex-supply-edit','uses'=>'ExtensionSupplyController@ex_edit']);
      Route::post('ex-supply-update/{id}',['as'=>'ex-supply-update','uses'=>'ExtensionSupplyController@ex_update']);
      Route::get('/ex_supply_temp', 'ExtensionSupplyController@ex_supply_temp')->name('ex_supply_temp');
      Route::get('surplus-delete/{id}','ExtensionSupplyController@destroy');

      Route::get('batch-edit/{nextNumber}',['as'=>'batch-edit','uses'=>'ExtensionSupplyController@batch_edit']);
      Route::post('batch-update/{nextNumber}',['as'=>'batch-update','uses'=>'ExtensionSupplyController@update_batch']);

      Route::get('updatee/{id}',['as'=>'updatee','uses'=>'ExtensionSupplyController@zero']);
     
      //Extension Supply View Surplus Information Route
      Route::get('/ex_supply_view', 'ExtensionSupplyController@ex_supply_view')->name('ex_supply_view');

      //Extension Supply Submitted View Surplus Information Route
      Route::get('view_supply_details',['as'=>'view_supply_details','uses'=>'ExtensionSupplyController@view_supply_details'])->middleware('can:view_extension_surplus,Auth::user()');
      Route::get('surplus-view-detail/{id}',['as'=>'surplus-view-detail','uses'=>'ExtensionSupplyController@ex_view_detail'])->middleware('can:extension_view_surplus_details,Auth::user()');

      //Extension Supply Submitted View Surplus Information edit Route
      Route::get('/editi-submitted/{id}','ExtensionSupplyController@edit_submitted')->name('editi-submitted')->middleware('can:extension_edit_surplus_details,Auth::user()');
      Route::post('/update-submitted/{id}','ExtensionSupplyController@update_submitted')->name('update-submitted');

      //Extension history Route
      Route::get('surplus-history',['as'=>'surplus-history','uses'=>'ExtensionSupplyController@show_history'])->middleware('can:extension_supply_history,Auth()::user()');
      Route::get('show-surplus/{id}','ExtensionSupplyController@ex_show')->name('show-surplus');;

      //Extension Under Cultivation
      Route::get('extension_cultivation',['as'=>'extension_cultivation','uses'=>'ExtensionUnderCultiavtionController@extension_cultivation'])->middleware('can:extension_add_under_cultivation,Auth::user()');
      Route::post('submit_cultivation_details',['as'=>'submit_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@submit_cultivation_details']);
      Route::get('view_cultivation_details',['as'=>'view_cultivation_details','uses'=>'ExtensionUnderCultiavtionController@view_cultivation_details'])->middleware('can:extension_view_under_cultivation,Auth::user()');
      Route::get('update_cultivation_status/{id}',['as'=>'update_cultivation_status','uses'=>'ExtensionUnderCultiavtionController@update_cultivation_status']);
      
      Route::get('cultivation-view/{id}',['as'=>'cultivation-view','uses'=>'ExtensionUnderCultiavtionController@cultivation_view']);
      Route::get('cultivation-edit/{id}',['as'=>'cultivation-edit','uses'=>'ExtensionUnderCultiavtionController@cultivation_edit']);
      Route::post('cultivation-update/{id}',['as'=>'cultivation-update','uses'=>'ExtensionUnderCultiavtionController@cultivation_update']);
      Route::get('cultivation-delete/{id}',['as'=>'cultivation-delete','uses'=>'ExtensionUnderCultiavtionController@cultivationDelete']);

      //Extension reports.
      Route::get('extension_report',['as'=>'extension_report','uses'=>'EXReportController@searchby']);
      Route::post('extension_dreport',['as'=>'extension_dreport','uses'=>'EXReportController@search_result']);

});

Route::group(['middleware' => 'can:aggregator_level, Auth::user()'], function() {

      //Commercial Aggregator Supply Surplus Information Route
      Route::get('date',['as'=>'date','uses'=>'CASurplusController@ca_expriydate'])->middleware('can:aggregator_add_surplus,Auth::user()');
      Route::post('store',['as'=>'store','uses'=>'CASurplusController@ca_store_transcation']);
      Route::get('ca-view',['as'=>'ca-view','uses'=>'CASurplusController@ca_store_transcation']);
      Route::post('supply-store',['as'=>'supply-store','uses'=>'CASurplusController@ca_store']);
      Route::get('supply-edit/{id}',['as'=>'supply-edit','uses'=>'CASurplusController@ca_edit']);
      Route::post('ca-update/{id}',['as'=>'ca-update','uses'=>'CASurplusController@ca_update']);
      Route::get('/ca_supply_temp', 'CASurplusController@ca_supply_temp')->name('ca_supply_temp');
      Route::get('/supply_view', 'CASurplusController@ca_supply_view')->name('supply_view');
      Route::get('supply-delete/{id}','CASurplusController@ca_destroy');
      Route::get('supply-history','CASurplusController@ca_show_history')->name('supply-history')->middleware('can:aggregator_supply_history,Auth::user()');
      Route::get('showe/{id}','CASurplusController@ca_show')->name('showe');

      Route::get('batch-editi/{nextNumber}',['as'=>'batch-editi','uses'=>'CASurplusController@batch_edit']);
      Route::post('batch-updatee/{nextNumber}',['as'=>'batch-updatee','uses'=>'CASurplusController@update_batch']);

      
      Route::get('update/{id}',['as'=>'update','uses'=>'CASurplusController@zero']);
      Route::get('view-surplus-nation',['as'=>'view-surplus-nation','uses'=>'CASurplusController@view_surplus_nation_all'])->middleware('can:view_surplus_nation,Auth::user()');
      
      //Commercial Aggregator Supply View Surplus Information Route
      Route::get('view_surplus_details',['as'=>'view_surplus_details','uses'=>'CASurplusController@ca_view_surplus_details'])->middleware('can:aggregator_view_surplus,Auth::user()');
      Route::get('/edit_submited/{id}','CASurplusController@ca_edit_submitted')->name('edit-submited')->middleware('can:aggregator_edit_surplus_details,Auth::user()');
      Route::post('update_submited/{id}',['as'=>'update_submited','uses'=>'CASurplusController@ca_update_submitted']);
      Route::get('view-details/{id}',['as'=>'view-details','uses'=>'CASurplusController@ca_view_detail'])->middleware('can:aggregator_view_surplus_details,Auth::user()');

      //report for aggregator.
      Route::get('aggregator_report',['as'=>'aggregator_report','uses'=>'CAReportController@searchby']);
      Route::post('aggregator_dreport',['as'=>'aggregator_dreport','uses'=>'CAReportController@search_result']);
      Route::get('aggregator_summary',['as'=>'aggregator_summary','uses'=>'CAReportController@searchsummaryby']);
      Route::post('aggregator_summaryreport',['as'=>'aggregator_summaryreport','uses'=>'CAReportController@summaryreport']);
      
      // Route::get('view_surplus_details',['as'=>'view_surplus_details','uses'=>'CASurplusController@view_surplus_details'])->middleware('can:aggregator_view_surplus,Auth::user()');

      //Commercial Aggregator Demand Surplus Information Route
      Route::get('demand-date',['as'=>'demand-date','uses'=>'CADemandController@expriydate'])->middleware('can:aggregator_demand_surplus,Auth::user()');
      Route::post('demanded-store',['as'=>'demanded-store','uses'=>'CADemandController@store_transcation']);
      Route::get('demanded-view',['as'=>'demanded-view','uses'=>'CADemandController@store_transcation']);
      Route::post('demand-store',['as'=>'demand-store','uses'=>'CADemandController@store']);
      Route::get('demand-delete/{id}','CADemandController@destroy');
      Route::get('demand-history','CADemandController@show_history')->name('demand-history')->middleware('can:aggregator_demand_history,Auth::user()');
      Route::get('demand-edit/{id}',['as'=>'demand-edit','uses'=>'CADemandController@edit']);
      Route::get('show/{id}','CADemandController@show')->name('show');
      Route::post('update-store/{id}',['as'=>'update-store','uses'=>'CADemandController@update']);
      Route::get('/demand_temp', 'CADemandController@demand_temp')->name('demand_temp');
      Route::get('/demand_view', 'CADemandController@demand_view')->name('demand_view');
      // Route::get('/json-submit-demand','CADemandController@submit_demand');
      // Route::get('/json-product-exist','CADemandController@product_exists');
      // Route::get('/json-product_type','CADemandController@product_type');

      Route::get('/json-transaction-exist','TransactionController@transaction_exists');
      Route::get('/json-dimport-exist/{id}','TransactionController@import_demand');

      // Route::get('/data_show', 'CADemandController@data_show')->name('data_show');
      
      //Commercial Aggregator Demand View Surplus Information 
      Route::get('view_surplus_demand_details',['as'=>'view_surplus_demand_details','uses'=>'CADemandController@view_surplus_demand_details'])->middleware('can:aggregator_view_demand_surplus,Auth::user()');
      Route::get('/edit_submitted/{id}','CADemandController@edit_submitted')->name('edit-submitted')->middleware('can:aggregator_edit_demand_details,Auth::user()');;
      Route::post('update_submitted/{id}',['as'=>'update_submitted','uses'=>'CADemandController@update_submitted']);
      Route::get('view-detail/{id}',['as'=>'view-detail','uses'=>'CADemandController@view_detail'])->middleware('can:aggregator_view_demand_details,Auth::user()');
      
      Route::get('view-nation',['as'=>'view-nation','uses'=>'CADemandController@view_surplus_nation']);


});

Route::group(['middleware' => 'can:master_data, Auth::user()'], function() {

      //Master product type.
      Route::get('product-type',['as' => 'product-type','uses'=>'ProductTypeController@producttype']);
      Route::post('product-type-store',['as'=>'product-type-store','uses'=>'ProductTypeController@producttypestore']);
      Route::get('product-type-edit/{id}',['as'=>'product-type-edit','uses'=>'ProductTypeController@producttypeedit']);
      Route::post('product-type-update/{id}',['as'=>'product-type-update','uses'=>'ProductTypeController@producttypeupdate']);
      Route::get('product-type-delete/{id}',['as'=>'product-type-delete','uses'=>'ProductTypeController@producttypedelete']);

      //master product.
      Route::get('product-create',['as'=>'product-create','uses'=>'ProductController@productcreate']);
      Route::post('product-store',['as'=>'product-store','uses'=>'ProductController@productstore']);
      Route::get('product-edit/{id}',['as'=>'product-edit','uses'=>'ProductController@productedit']);
      Route::post('product-update/{id}',['as'=>'product-update','uses'=>'ProductController@productupdate']);
      Route::get('product-delete/{id}',['as'=>'product-delete','uses'=>'ProductController@Productdestroy']);

      //master units.
      Route::get('unit-create',['as'=>'unit-create','uses'=>'UnitController@unitcreate']);
      Route::post('unit-store',['as'=>'unit-store','uses'=>'UnitController@unitstore']);
      Route::get('unit-edit/{id}',['as'=>'unit-edit','uses'=>'UnitController@unitedit']);
      Route::post('unit-update/{id}',['as'=>'unit-update','uses'=>'UnitController@unitupdate']);
      Route::get('unit-delete/{id}',['as'=>'unit-delete','uses'=>'UnitController@unitdelete']);

      //master cultivation units.
      Route::get('cunit-create',['as'=>'cunit-create','uses'=>'CUnitController@cunitcreate']);
      Route::post('cunit-store',['as'=>'cunit-store','uses'=>'CUnitController@cunitstore']);
      Route::get('cunit-edit/{id}',['as'=>'cunit-edit','uses'=>'CUnitController@cunitedit']);
      Route::post('cunit-update/{id}',['as'=>'cunit-update','uses'=>'CUnitController@cunitupdate']);
      Route::get('cunit-delete/{id}',['as'=>'cunit-delete','uses'=>'CUnitController@cunitdelete']);

      //master dzongkhag
      Route::get('dzongkhag-list',['as'=>'dzongkhag-list','uses'=>'DzongkhagThromdeController@index']);
      Route::post('dzongkhag-store',['as'=>'dzongkhag-store','uses'=>'DzongkhagThromdeController@dzongkhagStore']);
      Route::get('dzongkhag-edit/{id}',['as'=>'dzongkhag-edit','uses'=>'DzongkhagThromdeController@dzongkhagEdit']);
      Route::post('dzongkhag-update/{id}',['as'=>'dzongkhag-update','uses'=>'DzongkhagThromdeController@dzongkhagUpdate']);
      Route::get('dzongkhag-delete/{id}',['as'=>'dzongkhag-delete','uses'=>'DzongkhagThromdeController@dzongkhagDelete']);

      //master region
      Route::get('region-list',['as'=>'region-list','uses'=>'RegionController@index']);
      Route::post('region-store',['as'=>'region-store','uses'=>'RegionController@regionStore']);
      Route::get('region-edit/{id}',['as'=>'region-edit','uses'=>'RegionController@regionEdit']);
      Route::post('region-update/{id}',['as'=>'region-update','uses'=>'RegionController@regionUpdate']);
      Route::get('region-delete/{id}',['as'=>'region-delete','uses'=>'RegionController@regionDelete']);
});
Route::group(['middleware' => 'can:access_control_list, Auth::user()'], function() {

      //Role Route
      Route::get('view-role',['as'=>'view-role','uses'=>'AccessControlListController@indexRole']);
      Route::get('add-role',['as'=>'add-role','uses'=>'AccessControlListController@addRole']);
      Route::post('store-role',['as'=>'store-role','uses'=>'AccessControlListController@storeRole']);
      Route::get('edit-role/{id}',['as'=>'edit-role','uses'=>'AccessControlListController@editRole']);
      Route::post('update-role',['as'=>'update-role','uses'=>'AccessControlListController@updateRole']);
      Route::get('destroy-role/{id}',['as'=>'destroy-role','uses'=>'AccessControlListController@destroyRole']);
      
      //Permission Route
      Route::get('view-permission',['as'=>'view-permission','uses'=>'AccessControlListController@indexPermission']);
      Route::get('add-permission',['as'=>'add-permission','uses'=>'AccessControlListController@addPermission']);
      Route::post('store-permission',['as'=>'store-permission','uses'=>'AccessControlListController@storePermission']);
      Route::post('update-permission',['as'=>'update-permission','uses'=>'AccessControlListController@updatePermission']);
      Route::get('edit-permission/{id}',['as'=>'edit-permission','uses'=>'AccessControlListController@editPermission']);
      Route::get('destroy-permission/{id}',['as'=>'destroy-permission','uses'=>'AccessControlListController@destroyPermission']);
      
      //User Route
      Route::get('system-user',['as'=>'system-user','uses'=>'AccessControlListController@user']);
      Route::get('user-view/{id}',['as'=>'user-view','uses'=>'AccessControlListController@userView']);
      Route::get('add-user',['as'=>'add-user','uses'=>'AccessControlListController@add']);
      Route::post('new-user',['as'=>'new-user','uses'=>'AccessControlListController@insert']);
      Route::get('/json-dzongkhag','AccessControlListController@dzongkhag');
      
      Route::get('edit-user/{id}',['as'=>'edit-user','uses'=>'AccessControlListController@edit']);
      Route::post('update-user',['as'=>'update-user','uses'=>'AccessControlListController@update']);
      Route::get('delete-user/{id}',['as'=>'delete-user','uses'=>'AccessControlListController@userDelete']);
      
      //user password reset
      Route::get('user-reset',['as'=>'user-reset','uses'=>'AccessControlListController@userResetPassword']);
      Route::get('user-resetpassword/{id}',['as'=>'user-resetpassword','uses'=>'AccessControlListController@passwordReset']);
      Route::post('user-passupdate',['as'=>'user-passupdate','uses'=>'AccessControlListController@passwordUpdate']);
            

  }); // end of acl group list


        //User profile Route
        Route::get('profile',['as'=>'profile','uses'=>'ProfileController@userprofile']);

       //change Password & Email & Contact Route
        Route::post('/changePassword','UpdateDetailsController@changePassword');
        Route::post('/changeEmail','UpdateDetailsController@changeEmail');
        Route::post('/changeContact','UpdateDetailsController@changeContact');
        Route::post('/changePassword','UpdateDetailsController@changePassword')->name('changePassword');
        Route::post('/changeEmail','UpdateDetailsController@changeEmail')->name('changeEmail');
        Route::post('/changeContact','UpdateDetailsController@changeContact')->name('changeContact');

        //Image Route
        Route::post('/avatar', 'UserController@update_avatar');

        //Reports.
        Route::get('reports',['as'=>'reports', 'uses'=>'ReportController@report']);
        Route::post('report-details',['as'=>'report-details', 'uses'=>'ReportController@search']);

        //Contact US
        Route::get('contact-us',['as'=>'contact-us','uses'=>'ContactUsController@contactUS']);
        Route::post('contact-post',['as'=>'contact-post','uses'=>'ContactUsController@contactUSPost']);

});

      // Extension 
      Route::get('/json-product_type','ExtensionSupplyController@product_type');
      Route::get('/json-submit-surplus','ExtensionSupplyController@ex_submit_supply');
      Route::get('/json-surplus-exist','ExtensionSupplyController@surplus_exists');
      Route::get('/json-farmer-unit_product','ExtensionSupplyController@unit_product');

      //CA Surplus
      Route::get('/json-product_type','CASurplusController@product_type');
      Route::get('/json-submit-supply','CASurplusController@submit_ca_supply');
      Route::get('/json-ca-product-exist','CASurplusController@ca_product_exists');
      Route::get('/json-ca-unit_product','CASurplusController@unit_product');

      //CA Demand
      Route::get('/json-submit-demand','CADemandController@submit_demand');
      Route::get('/json-product-exist','CADemandController@product_exists');
      Route::get('/json-product_type','CADemandController@product_type');


      //Notification
      Route::get('maskAsRead', function(){
            Auth::User()->unReadNotifications->markAsRead();
            return redirect()->back();
      })->name('read');



      Route::get('extension-summary',['as'=>'extension-summary','uses'=>'EXReportController@searchby_summary']);
      Route::post('extension_sreport',['as'=>'extension_sreport','uses'=>'EXReportController@summary_report']);
      //call this controller to insert summary details into monthly table.
      // Route::get('/sum','SummaryController@sum_quantity_type');
      
      //Dynamic input form.
      Route::get('extension-create',['as'=>'extension-create','uses'=>'FarmerController@create']);

     
      
