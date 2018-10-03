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

Route::get('/', 'HomeController@index');
Route::get('/hubungi-kami', 'HomeController@contact');
Route::post('/hubungi-kami', 'HomeController@send');
Route::get('/page/',function (){
    return redirect('/');
});
Route::get('/page/{slug}','HomeController@show');
Route::get('/posts', 'PostController@index');
Route::get('/posts/{slug}', 'PostController@show');
Route::get('/category', 'CategoryController@index');
Route::get('/category/{slug}', 'CategoryController@show');
Route::get('/search','PostController@searchindex');
Route::get('/search/{keywords}','PostController@search');
Route::post('/cari','PostController@cari');
Route::post('/logout','Auth\LoginController@logout');
Route::post('/register','UserController@register');
Route::post('/forget-password','UserController@forgot');
Route::get('/author', 'UserController@author');
Route::get('/author/{id}', 'UserController@authorShow');
Route::post('/author/{id}', 'GuestController@profile');
Route::get('/kabar-baik','GuestController@tulisanForm');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
