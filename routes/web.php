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
    return view('layout');
});

//Route::any('{slug}', function () {
//    return view('layout');
//});

Route::get('/{vue_capture?}',function () {
    return view('layout');
})->where('vue_capture', '[\/\w\.-]*');
