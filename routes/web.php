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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');


Route::get('/add-product','ProductController@index')->name('add-product');
Route::post('/add-product','ProductController@store')->name('save-product');

