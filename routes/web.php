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
Route::get('/products/{id}', 'ProductController@show');

//Aplicando namespace Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function(){
	Route::get('/products', 'Admin\ProductController@index'); // para ver el listado
	Route::get('/products/create', 'Admin\ProductController@create'); // para ver el formulario registro
	Route::post('/products', 'Admin\ProductController@store'); // para registrar los datos en la BD
	Route::get('/products/{id}/edit', 'Admin\ProductController@edit'); // para ver el formulario edición
	Route::post('/products/{id}/edit', 'Admin\ProductController@update'); // para actualizar los datos en la BD
	Route::delete('/products/{id}', 'Admin\ProductController@destroy'); // form eliminar
	
	Route::get('/products/{id}/images', 'Admin\ImageController@index'); //listado
	Route::post('/products/{id}/images', 'Admin\ImageController@store'); //Registrar
	Route::delete('/products/{id}/images', 'Admin\ImageController@destroy'); //form eliminar
	Route::get('/products/{id}/images/select/{image}', 'Admin\ImageController@select'); //destacar
});