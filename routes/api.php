<?php

use Illuminate\Http\Request;

//Route::resource("v1/stocks",'Api\v1\StockController');
Route::post('register','Api\v1\RegisterTokenController@index');
Route::post('login','Api\v1\LoginTokenController@index');

Route::group([
    'prefix' => 'v1', 
    'middleware' => 'auth:api'
], function(){
    Route::resource("stocks",'Api\v1\StockController');
});

