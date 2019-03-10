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

Route::get('/home', 'HomeController@index')->name('home');


        // // Registration Routes...
        // if ($options['register'] ?? true) {
        //     $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        //     $this->post('register', 'Auth\RegisterController@register');
        // }

        // // Password Reset Routes...
        // if ($options['reset'] ?? true) {
        //     $this->resetPassword();
        // }

        // // Email Verification Routes...
        // if ($options['verify'] ?? false) {
        //     $this->emailVerification();
        // }