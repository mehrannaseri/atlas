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

Route::prefix('panel/staff')->group(function() {
    Route::get('/', 'StaffController@index')->name('list');
    Route::get('/add' , 'StaffController@create')->name('add');
    Route::post('/add' , 'StaffController@store');
    Route::get('/access_level' , 'StaffController@access_level');
    Route::post('/setPermission' , 'StaffController@setPermission');
    Route::get('edit/{id}','StaffController@edit');
    Route::post('edit/{id}' , 'StaffController@update');
});
