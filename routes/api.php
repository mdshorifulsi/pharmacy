<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Auth','middleware' => 'api','prefix' => 'auth'], function ($router) {


    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});



Route::group(['namespace' => 'App\Http\Controllers\Admin'], function ($router) {

    Route::apiResource('category', 'CategoryController');
    Route::apiResource('brand', 'BrandController');
    Route::apiResource('product', 'ProductController');


    Route::get('/stock', 'StockController@stock');
    Route::post('/stock/update/{id}', 'StockController@stock_update');


    Route::get('/expense', 'ExpenseController@allexpense');
    Route::post('/addexpense', 'ExpenseController@addexpense');
    Route::get('/deleteexpense/{id}', 'ExpenseController@deleteexpense');
    Route::get('/editexpense/{id}', 'ExpenseController@editexpense');
    Route::post('/updateexpense/{id}', 'ExpenseController@updateexpense');


    Route::get('/getting/product/{id}', 'PosController@getProduct');

    Route::get('/addtocard/{id}', 'CartController@addtocard');
    Route::get('/cart/product', 'CartController@cartproduct');
     Route::get('/remove/cart/{id}', 'CartController@removeCart');
    Route::get('/increment/{id}', 'CartController@increment');
    Route::get('/decrement/{id}', 'CartController@decrement');


    Route::post('/orderdone', 'OrderController@orderdone');
    Route::get('/allorder', 'OrderController@allorder');
    Route::get('/order/details/{id}', 'OrderController@details');
    Route::get('/order/{oid}', 'OrderController@order');


    Route::get('/todaysell', 'DashboardController@todaysell');
    Route::get('/todayincome', 'DashboardController@todayincome');
    Route::get('/todaydue', 'DashboardController@todaydue');
    Route::get('/todayexpense', 'DashboardController@todayexpense');
    Route::get('/stockout', 'DashboardController@stockout');
    Route::get('/expirydate', 'DashboardController@expirydate');


   

});