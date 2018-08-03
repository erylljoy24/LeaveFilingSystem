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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/fileLeave', 'HomeController@showForm');
Route::post('/home/fileLeave', 'HomeController@storeLeave');
Route::delete('/home/cancel/{leave_id}', 'HomeController@deleteLeave');

Route::group(['prefix' => 'admin'], function(){

  // AdminLoginController controller
  Route::get('/', 'AdminLoginController@showLogin');
  Route::post('/login', 'AdminLoginController@login');

  // AdminController Controller
  Route::get('/home', 'AdminController@home');

  // AdminTablesController controller
  Route::put('/approve/{id}', 'AdminTablesController@approveRequest');
  Route::put('/reject/{id}', 'AdminTablesController@rejectRequest');
  Route::get('/view/{id}', 'AdminTablesController@viewRequest');
  Route::get('/table', 'AdminTablesController@displayTable');
  Route::get('/sortby', 'AdminTablesController@sortBy');
});
