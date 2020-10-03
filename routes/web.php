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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'Auth\LoginController@inicio');

// HOJAS DE RUTA
Route::get('HojasRuta/registro', 'HojasRutaController@registro');
Route::get('HojasRuta/listado', 'HojasRutaController@listado');
Route::get('HojasRuta/ajax_listado', 'HojasRutaController@ajax_listado');
Route::get('HojasRuta/asignacion/{id}', 'HojasRutaController@asignacion');
Route::post('HojasRuta/guarda', 'HojasRutaController@guarda');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
