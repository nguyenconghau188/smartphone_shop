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

Route::get('/', function () {
    return view('client.pages.home');
});

Route::get('admin/login', 'AdminLoginController@getLogin');
Route::post('admin/login', 'AdminLoginController@postLogin');
Route::get('admin/logout', 'AdminLoginController@getLogout');

Route::group(['prefix'=>'pages'], function(){
	Route::get('home', 'PagesController@homePage');
	Route::get('advandce_product', 'PagesController@advandceProduct');
	Route::get('nearadv_product', 'PagesController@nearadvProduct');
	Route::get('normal_product', 'PagesController@normalProduct');
	Route::get('basic_product', 'PagesController@basicProduct');
	Route::get('product/{id}', 'PagesController@productDetail');
});

Route::group(['middleware'=>'checkLogin','prefix'=>'admin'], function(){
	Route::group(['prefix'=>'products'], function(){
		Route::get('list', 'ProductsController@listProduct');
		Route::get('add', 'ProductsController@getAdd');
		Route::post('add', 'ProductsController@postAdd');
		Route::get('delete/{id}', 'ProductsController@getDelete');
		Route::get('edit/{id}', 'ProductsController@getEdit');
		Route::post('edit/{id}', 'ProductsController@postEdit');
	});
	Route::group(['prefix'=>'manufactories'], function(){
		Route::get('list', 'ManufactoriesController@listManufactories');
		Route::get('add', 'ManufactoriesController@getAdd');
		Route::post('add', 'ManufactoriesController@postAdd');
		Route::get('delete/{id}', 'ManufactoriesController@getDelete');
		Route::get('edit/{id}', 'ManufactoriesController@getEdit');
		Route::post('edit/{id}', 'ManufactoriesController@postEdit');
	});
	Route::group(['prefix'=>'types_product'], function(){
		Route::get('list', 'TypesProductController@listTypesProduct');
		Route::get('add', 'TypesProductController@getAdd');
		Route::post('add', 'TypesProductController@postAdd');
		Route::get('delete/{id}', 'TypesProductController@getDelete');
		Route::get('edit/{id}', 'TypesProductController@getEdit');
		Route::post('edit/{id}', 'TypesProductController@postEdit');
	});
	Route::group(['prefix'=>'users'], function(){
		Route::get('list', 'UserController@listUser');
		Route::get('add', 'UserController@getAdd');
		Route::post('add', 'UserController@postAdd');
		Route::get('delete/{id}', 'UserController@getDelete');
		Route::get('edit/{id}', 'UserController@getEdit');
		Route::post('edit/{id}', 'UserController@postEdit');
	});
	Route::group(['prefix'=>'customers'], function(){
		Route::get('list', 'CustomerController@listCustomer');
		Route::get('add', 'CustomerController@getAdd');
		Route::post('add', 'CustomerController@postAdd');
		Route::get('delete/{id}', 'CustomerController@getDelete');
		Route::get('edit/{id}', 'CustomerController@getEdit');
		Route::post('edit/{id}', 'CustomerController@postEdit');
	});
});