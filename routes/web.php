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

Route::get('/', function () {
    return view('welcome');
    // return "Hello World!";
});

Route::get('/pzn', function () {
    return "Hello Programmer zaman now";
});

Route::redirect('/youtube', 'pzn');

Route::fallback(function () {
    return "404 By Programmer Zaman Now";
});
