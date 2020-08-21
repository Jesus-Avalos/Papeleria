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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Livewire routes
Route::livewire('/categorias', 'categorias');
Route::livewire('/inventario', 'inventario');
Route::livewire('/productos', 'productos');
Route::livewire('/clientes', 'clientes');
Route::livewire('/proveedores', 'proveedores');
Route::livewire('/ventas', 'ventas');