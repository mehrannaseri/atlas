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


Route::get('/', function(){
    return view('welcome');
});


Auth::routes();

Route::get('/panel', 'DashboardController@index')->name('dashboard');
Route::post('panel/language/','DashboardController@addLanguage');
Route::post('panel/language/edit/{id}' , 'DashboardController@update');
Route::get('panel/language/remove/{id}' , 'DashboardController@delete');
