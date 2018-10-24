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
    Route::get('/edit/{id}','StaffController@edit');
    Route::post('/edit/{id}' , 'StaffController@update');
    Route::get('/delete/{id}' , 'StaffController@destroy');

    Route::get('/access_level' , 'RolesController@access_level');
    Route::post('/setPermission' , 'RolesController@setPermission');
    Route::get('/organization' , 'RolesController@index');
    Route::post('/role/add' , 'RolesController@store');
    Route::post('/role/update/{id}' , 'RolesController@update');
});
