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

Route::get('/', 'ShopCategoriesController@index');

Route::resource('shop_categories','ShopCategoriesController');
Route::resource('shops','ShopsController');
Route::resource('shop_users','ShopUsersController');
Route::resource('admins','AdminsController');

Route::get('/un_pass','ShopsController@un_pass');
Route::post('/shop_pass/{shop}','ShopsController@pass')->name('shop_pass');
Route::get('/shop_user_pass/{shop_user}','ShopUsersController@pass')->name('shop_user_pass');

Route::post('/login','SessionController@login')->name('login');
Route::get('/logout','SessionController@logout')->name('logout');
Route::get('/reset_password','SessionController@reset_password')->name('reset_password');
Route::PATCH('/reset_password_store','SessionController@reset_password_store')->name('reset_password_store');
Route::get('/shop_user_password/{shop_user}','ShopUsersController@shop_user_password')->name('shop_user_password');
Route::PATCH('/shop_user_password_store/{shop_user}','ShopUsersController@shop_user_password_store')->name('shop_user_password_store');
