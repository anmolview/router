<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'WEB'], function () {
    Route::get('/', 'RouterController@index')->name('router.index');
    Route::get('add', 'RouterController@create')->name('router.create');
    Route::post('add', 'RouterController@store')->name('router.store');
    Route::get('{id}', 'RouterController@edit')->name('router.edit');
    Route::delete('{id}', 'RouterController@destroy')->name('router.destroy');
    Route::patch('{id}', 'RouterController@update')->name('router.update');
});

