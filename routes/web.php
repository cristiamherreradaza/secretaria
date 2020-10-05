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
Route::get('HojasRuta/ajax_asignados', 'HojasRutaController@ajax_asignados');
Route::get('HojasRuta/asignados', 'HojasRutaController@asignados');
Route::get('HojasRuta/asignar/{id}', 'HojasRutaController@asignar');
Route::post('HojasRuta/guarda', 'HojasRutaController@guarda');
Route::post('HojasRuta/guardaAsignacion', 'HojasRutaController@guardaAsignacion');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
