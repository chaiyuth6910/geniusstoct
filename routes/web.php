<?php

Route::get('/', function () {
    return view('welcome');
});

// Route for auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


// Admin area
Route::get('admin/routes','HomeController@admin')->middleware('admin');