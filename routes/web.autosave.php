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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin','AdminPageController@dashboard')->name('dashboard');
Route::get('/admin/material','AdminPageController@material')->name('material');
Route::post('/admin/material','MaterialController@store')->name('material.store');
Route::get('/admin/material/{id}','AdminPageController@test')->name('material.edit');

Route::get('/admin/material/test','MaterialController@test');

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
	
	Route::resource('/users', 'UsersController',['except'=>['show','create','store']]);
});