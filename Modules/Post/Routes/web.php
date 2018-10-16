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

Route::prefix('panel/post')->group(function() {
    Route::get('/add', 'PostController@create');
    Route::get('/category' , 'CategoryController@index');
    Route::post('/category/getByLang' , 'CategoryController@catsBylang');
    Route::post('category/add' , 'CategoryController@store');
    Route::post('category/update/{id}' , 'CategoryController@update');
});
