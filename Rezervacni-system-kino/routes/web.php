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

use Illuminate\Support\Facades\Route;

Route::get('', 'WelcomeController');

Route::resource('performance', 'PerformanceController');

Route::resource('piece', 'PieceController');

Route::resource('user', 'UserController');

Route::resource('hall', 'HallController');

Route::resource('reservation', 'ReservationController');
Route::get('myReservations', 'ReservationController@myReservations')->name('reservation.myReservations');
Route::get('{reservation}/pay', 'ReservationController@pay')->name('reservation.pay');
Route::get('createOnPerformance/{performance_id}/{hall_id}', 'ReservationController@createOnPerformance')->name('reservation.createOnPerformance');


Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
