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

Auth::routes();

Route::get('/', 'HomeController@welcome');

Route::group(['middleware'=>'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('move/{move}/{pos}', 'PageController@move');
    Route::get('/logout', 'HomeController@logout');
    Route::group(['prefix'=>'page'], function () {
        Route::get('create', 'PageController@create');
        Route::post('save/{id?}', 'PageController@save');
        Route::get('delete/{id}', 'PageController@delete');
        Route::get('{id}', 'PageController@show');
        Route::post('{id}/{type}/{name}', 'PageController@image');
    });
});
