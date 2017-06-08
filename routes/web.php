<?php

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

Route::resource('outlet-types','OutletTypeController');
Route::resource('product-types','ProductTypeController');
Route::resource('outlets','KedaiController');
Route::resource('orders','OrderController');
Route::resource('menus','MenuController');
Route::resource('users', 'UserController');

Route::resource('regions', 'RegionController');
Route::resource('districts', 'DistrictController');
Route::resource('areas', 'AreaController');

Route::get('/regions/{id}/districts', 'RegionController@district');
Route::get('/districts/{id}/areas', 'DistrictController@area');

Route::group(['prefix' => 'users'], function () {
    Route::post('{id}/get-activation-code', 'UserController@getActivationCode');
    Route::post('{id}/activate', 'UserController@activateUser');
    Route::post('{id}/get-member-activation-code', 'UserController@getMemberActivationCode');
    Route::post('{id}/activate-member', 'UserController@activateMember');
});

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'management'], function () {
    Route::get('customer','ManagementController@customer');
    Route::get('kedai', ['as'=>'management.kedai','uses'=>'ManagementController@outlet']);
    Route::get('member',['as'=>'management.member','uses'=>'ManagementController@member']);
});

Route::group(['prefix' => 'reporting'], function () {
    Route::get('resume','ReportingController@resume');
    Route::get('customer', ['as'=>'management.kedai','uses'=>'ReportingController@customer']);
    Route::get('detail',['as'=>'management.member','uses'=>'ReportingController@detail']);
});

Route::group(['prefix' => 'menu'], function () {
    Route::post('group', ['as'=>'kedai.menu','uses'=>'MenuController@storeMenuGroup']);
    Route::post('detail', ['as'=>'kedai.menu.detail','uses'=>'MenuController@storeMenu']);
    Route::get('prices/{product_id}', 'MenuController@getPrice');
    Route::post('prices', ['as'=>'kedai.menu.harga','uses'=>'MenuController@storePrice']);
    Route::get('{outlet_id}/{product_group_id}','MenuController@menu');
    Route::get('{outlet_id}', 'MenuController@menuGroup');
});

Route::group(['prefix' => 'administration'], function () {
    Route::get('outlet-type' , ['as'=>'administration.outlettype','uses'=>'ManagementController@outletType']);
    Route::get('product-type' , ['as'=>'administration.producttype','uses'=>'ManagementController@productType']);
    Route::get('user' , ['as'=>'administration.user','uses'=>'ManagementController@user']);
     Route::get('territory' , ['as'=>'administration.territory','uses'=>'ManagementController@territory']);
});


Auth::routes();

Route::get('/home', 'HomeController@index');
