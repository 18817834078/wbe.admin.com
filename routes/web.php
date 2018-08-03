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

Route::get('/', 'SessionController@to_index');

Route::resource('shop_categories','ShopCategoriesController');
Route::resource('shops','ShopsController');
Route::resource('shop_users','ShopUsersController');
Route::resource('admins','AdminsController');
Route::resource('activities','ActivitiesController');
Route::get('/navs.index','NavsController@index')->name('navs.index');
Route::resource('navs','NavsController');
Route::get('/events.index','EventsController@index')->name('events.index');
Route::get('/open/{event}','EventsController@open')->name('open');
Route::resource('events','EventsController');

//Route::post('/event_prizes.store/{event}','EventPrizesController@index')->name('event_prizes.store');
Route::resource('event_prizes','EventPrizesController');
Route::resource('event_members','EventMembersController');

//Route::resource('users','MansController');

Route::get('/users.index','MansController@index')->name('users.index');
Route::get('/users.show/{user}','MansController@show')->name('users.show');
Route::post('/users.change_status/{user}','MansController@change_status')->name('users.change_status');

Route::get('/un_pass','ShopsController@un_pass');
Route::post('/users.status','UsersController@status')->name('users.status');
Route::get('orders.count','OrdersController@count')->name('orders.count');
Route::get('menus.count','MenusController@count')->name('menus.count');
Route::post('/shop_pass/{shop}','ShopsController@pass')->name('shop_pass');
Route::get('/shop_user_pass/{shop_user}','ShopUsersController@pass')->name('shop_user_pass');

Route::post('/login','SessionController@login')->name('login');
Route::get('/logout','SessionController@logout')->name('logout');
Route::get('/reset_password','SessionController@reset_password')->name('reset_password');
Route::get('/login_view','SessionController@login_view')->name('login_view');
Route::PATCH('/reset_password_store','SessionController@reset_password_store')->name('reset_password_store');
Route::get('/shop_user_password/{shop_user}','ShopUsersController@shop_user_password')->name('shop_user_password');
Route::PATCH('/shop_user_password_store/{shop_user}','ShopUsersController@shop_user_password_store')->name('shop_user_password_store');

//图片上传
Route::post('web_upload',function (){
    $storage=\Illuminate\Support\Facades\Storage::disk('oss');
    $file_name=$storage->putFile('/shop_category',request()->file('file'));
    return ['file_name'=>$storage->url($file_name)];
})->name('web_upload');
Route::post('web_upload_shop',function (){
    $storage=\Illuminate\Support\Facades\Storage::disk('oss');
    $file_name=$storage->putFile('/shop',request()->file('file'));
    return ['file_name'=>$storage->url($file_name)];
})->name('web_upload_shop');

//权限相关
//Route::resource('permissions','PermissionsController');
Route::get('permissions.index','PermissionsController@index')->name('permissions.index');
Route::post('permissions.create','PermissionsController@create')->name('permissions.create');
Route::DELETE('permissions.destroy/{permission}','PermissionsController@destroy')->name('permissions.destroy');
Route::PATCH('permissions.update/{permission}','PermissionsController@update')->name('permissions.update');
//角色相关
Route::resource('roles','RolesController');
//Route::get('roles.index','PermissionsController@index')->name('roles.index');
//Route::post('roles.create','PermissionsController@create')->name('roles.create');
//Route::DELETE('roles.destroy/{role}','PermissionsController@destroy')->name('roles.destroy');
//Route::PATCH('roles.update/{role}','PermissionsController@update')->name('roles.update');