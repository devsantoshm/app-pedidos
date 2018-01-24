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

Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');

Route::post('/order', 'CartController@update');

//Aplicando namespace Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function(){
	Route::get('/products', 'ProductController@index'); // para ver el listado
	Route::get('/products/create', 'ProductController@create'); // para ver el formulario registro
	Route::post('/products', 'ProductController@store'); // para registrar los datos en la BD
	Route::get('/products/{id}/edit', 'ProductController@edit'); // para ver el formulario edición
	Route::post('/products/{id}/edit', 'ProductController@update'); // para actualizar los datos en la BD
	Route::delete('/products/{id}', 'ProductController@destroy'); // form eliminar
	
	Route::get('/products/{id}/images', 'ImageController@index'); //listado
	Route::post('/products/{id}/images', 'ImageController@store'); //Registrar
	Route::delete('/products/{id}/images', 'ImageController@destroy'); //form eliminar
	Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //destacar

	Route::get('categories', 'CategoryController@index'); // para ver el listado
	Route::get('/categories/create', 'CategoryController@create'); // para ver el formulario registro
	Route::post('/categories', 'CategoryController@store'); // para registrar los datos en la BD
	Route::get('/categories/{category}/edit', 'CategoryController@edit'); // para ver el formulario edición
	Route::post('/categories/{category}/edit', 'CategoryController@update'); // para actualizar los datos en la BD
	Route::delete('/categories/{category}', 'CategoryController@destroy'); // form eliminar
});