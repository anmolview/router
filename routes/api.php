<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['namespace' => 'API'], function () {
    Route::post('login', 'UserController@login');
    Route::post('signup', 'UserController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'UserController@logout');
        Route::get('/', 'RouterController@index');
        Route::get('/add', 'RouterController@create');
        Route::post('/add', 'RouterController@store');
        Route::get('/{id}', 'RouterController@edit');
        Route::delete('/{id}', 'RouterController@destroy');
        Route::patch('/{id}', 'RouterController@update');
        Route::get('/filter-ip/{ip}', 'RouterController@filterIpRanges');
    });
});
