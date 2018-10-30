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

Route::prefix('panel/dynaform')->group(function() {
    Route::get('/', 'DynaformController@index')->middleware('auth');
    Route::get('/add', 'DynaformController@create')->middleware('auth');
    Route::post('/store', 'DynaformController@store')->name('panel.dynaform.store');
    Route::post('/update', 'DynaformController@update')->name('panel.dynaform.update');
    Route::get('show/{id}', 'DynaformController@show');
    Route::get('edit/{id}', 'DynaformController@edit');
    Route::get('delete/{id}', 'DynaformController@destroy');
    Route::get('show/users/{id}', 'DynaformController@users_form');
    Route::get('show/form/{fid}/user/{uid}', 'DynaformController@user_form_detail');
    Route::post('/save', 'DynaformController@save')->name('panel.dynaform.save');
});
