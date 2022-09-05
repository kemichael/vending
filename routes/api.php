<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\SalesController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sales', 'Api\SalesController@index');
Route::post('/sales/create/{id}', 'Api\SalesController@create');
Route::put('/sales/update/{id}', 'Api\SalesController@update')->name('sold');