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

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/products', 'ProductController@index'); // para ver el listado
Route::get('/admin/products/create', 'ProductController@create'); // para ver el formulario registro
Route::post('/admin/products', 'ProductController@store'); // para registrar los datos en la BD
Route::get('/admin/products/{id}/edit', 'ProductController@edit'); // para ver el formulario edición
Route::post('/admin/products/{id}/edit', 'ProductController@update'); // para actualizar los datos en la BD
Route::delete('/admin/products/{id}', 'ProductController@destroy'); // form eliminar
