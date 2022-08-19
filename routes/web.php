<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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
});

Route::group(['middleware' => 'jwtauth'], function(){
    Route::post('customer', [CustomerController::class, 'store']);
    Route::get('get-customer', [CustomerController::class, 'getCustomer']);
    Route::post('customer-update', [CustomerController::class, 'update']);
    Route::delete('customer-destroy/{id}', [CustomerController::class, 'destroy']);
});
