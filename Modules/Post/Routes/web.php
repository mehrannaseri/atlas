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
    Route::get('/category' , 'CategoryController@index');
    Route::post('/category/getByLang' , 'CategoryController@catsBylang');
    Route::post('category/add' , 'CategoryController@store');
    Route::post('category/update/{id}' , 'CategoryController@update');
    Route::get('category/remove/{id}' , 'CategoryController@destroy');

    Route::get('tags' , 'TagsController@index');
    Route::post('tag/add' , 'TagsController@store');
    Route::post('tag/update/{id}' , 'TagsController@update');
    Route::get('tag/remove/{id}' , 'TagsController@destroy');

    Route::get('/' , 'PostController@index');
    Route::get('/add', 'PostController@create')->name('add');
    Route::get('/setDir' , 'PostController@setDir');
    Route::post('/store' , 'PostController@store');
    Route::get('/edit/{id}' , 'PostController@edit');
});
