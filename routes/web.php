<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products', 'ProductsListController@showList') ->name('products');  

Route::get('/product.regist', 'ProductRegistController@regist') ->name('regist');

Route::get('/product.detail/{id}', 'ProductslistController@detail') ->name('detail');

Route::get('/product.edit/{id}', 'ProductsListController@edit') ->name('edit');

Route::post('/product.regist', 'ProductRegistController@store') ->name('store');

Route::patch('/product.edit/{id}', 'ProductsListController@update') ->name('update');

Route::post('/products.delete/{id}', 'ProductsListController@delete') ->name('delete');
