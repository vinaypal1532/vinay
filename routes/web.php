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
Route::resource('users','LoginController');
Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'LoginController@login');
Route::post('userlogin', 'LoginController@loginuserdata');
Route::get('dashboard', 'LoginController@dashboard');
Route::get('logout', 'LoginController@logout');
Route::get('registration', 'LoginController@registration');
 Route::post('post-registration', 'LoginController@postRegistration'); 