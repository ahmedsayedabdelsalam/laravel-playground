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

Route::get('/', 'UserController@index');

Route::get('/books', 'BookController@index');

Route::get('/features', 'FeatureController@index');

Route::get('/checkouts', 'CheckoutController@index');
