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

Route::redirect('/', '/home', 301);

Auth::routes();

//パスワードリセット無効化
Route::redirect('/password/reset', '/home', 301);

Route::get('/home/{id}', 'HomeController@edit');
Route::get('/home', 'HomeController@index');
Route::get('/view/{id}', 'SiteDataDBController@view');
Route::get('/view-all', 'HomeController@viewAll');

Route::post('/delete/{id}/{url?}', 'SiteDataDBController@delete');
Route::post('/upload', 'SiteDataDBController@upload');


//api
Route::resource('api', 'GcccSiteAPIController');