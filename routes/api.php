<?php

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


Route::group(['namespace' => 'API\V1'], function () {
    Route::get('product', 'ProductController@index');
    Route::post('product', 'ProductController@store');
    Route::put('product/{product}', 'ProductController@update');
    Route::delete('product/{product}', 'ProductController@destroy');
});
