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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/basket', 'BasketController@basket')->name('basket');
Route::post('/basket/delete/{id}', 'BasketController@deleteFromBasket')->name('basket-delete');
Route::post('/basket/add/{id}', 'BasketController@addToBasket')->name('basket-add');
Route::get('/basket/checkout', 'BasketController@checkout')->name('basket-checkout');
Route::post('/basket/checkout/confirm', 'BasketController@confirm')->name('basket-confirm');
