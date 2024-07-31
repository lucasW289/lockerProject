<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/register');
});
Route::view('/login',"auth/login")->name('login');

Route::group(['middleware' => ['role:1']], function () {
    // Routes accessible only by primary admin
});

Route::group(['middleware' => ['role:2']], function () {
    // Routes accessible only by administrators
});

Route::group(['middleware' => ['role:3']], function () {
    // Routes accessible only by users
});
