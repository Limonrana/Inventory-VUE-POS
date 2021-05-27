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

Route::apiResource('/supplier', 'Supplier\SupplierController');
Route::apiResource('/category', 'Product\CategoryController');
Route::apiResource('/expense', 'Expense\ExpenseController');

//API Routes for get data
Route::get('/getcategory', 'Product\CategoryController@getCategory');
Route::get('/getsupplier', 'Supplier\SupplierController@getSupplier');

//Product Routes
Route::apiResource('/product', 'Product\ProductController');
Route::post('/product/upload', 'Product\ProductController@uploadImage');
Route::post('/product/image/delete', 'Product\ProductController@deleteImage');

//Stock Management
Route::post('/product/stock-update/{id}', 'Product\ProductController@stockUpdate');

//Employee and Salary Routes
Route::apiResource('/employee', 'Employee\EmployeeController');
Route::get('/pay-employee', 'Employee\SalaryController@pay');
Route::get('/paid-employee', 'Employee\SalaryController@paid');
Route::get('/all-salary', 'Employee\SalaryController@index');
Route::get('/view-salary/{id}', 'Employee\SalaryController@viewSalary');
Route::Post('/pay-salary/{id}', 'Employee\SalaryController@store');


//Authentication Routes List
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'Auth\AuthController@login');
    Route::post('signup', 'Auth\AuthController@signup');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');

});
