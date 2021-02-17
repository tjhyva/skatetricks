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


Route::get('/', 'CategoryController@index');

Route::get('/trick/{category}', 'TrickController@trick');

Route::get('/trick/like/{id}/{like}', 'TrickController@like');

Route::post('/trick','TrickController@store');

Route::get('/trick/delete/{id}', 'TrickController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
