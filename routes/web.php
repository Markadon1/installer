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

Route::get('/', 'PagesController@index');

Route::get('/category', 'PagesController@category');
Route::get('/category/create', 'CategoryController@redirect_to_create');
Route::post('/category/create', 'CategoryController@create');

Route::post('/subcategory/create','CategoryController@sub_create');

Route::post('/subcat_input/create','CategoryController@sub_input_create');

Route::post('/login/enter','Auth\LoginController@enter');

Route::post('register/change_type', 'AjaxController@reg_change');
Route::post('register/send', 'Auth\RegisterController@create');
Route::post('register/success','Auth\RegisterController@success');

Route::get('register/{token}', 'Auth\RegisterController@confirmEmail');
Route::post('register/{token}/confirm_phone', 'Auth\RegisterController@confirmPhone');
Route::post('register/{token}/confirm_phone/resend', 'Auth\RegisterController@resendPhone');

Route::get('reset','Auth\ResetPasswordController@index');
Route::post('reset/send','Auth\ResetPasswordController@send');
Route::get('reset/{token}', 'Auth\ResetPasswordController@reset');
Route::post('reset/confirm', 'Auth\ResetPasswordController@save');

Auth::routes();
