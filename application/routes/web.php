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

Route::resources([
    'pacientes'    => 'pacientesController',
    'dentistas'    => 'dentistasController',
    'convenios'    => 'ConveniosController',
    'procedimentos'=> 'ProcedimentosController',

]);

Route::get('api/pacientes/{term?}', 'pacientesController@listar')->name('api.pacientes');
Route::get('api/dentistas/{term?}', 'dentistasController@listar')->name('api.dentistas');
Route::get('api/convenios/{term?}', 'ConveniosController@listar')->name('api.convenios');
Route::get('api/procedimentos/{term?}', 'ProcedimentosController@listar')->name('api.procedimentos');

Route::get('api/consultas/{term?}', 'ConsultasController@listar')->name('api.consultas');
Route::get('consultas', 'ConsultasController@index')->name('consultas.index');
Route::post('consultas', 'ConsultasController@store')->name('consultas.store');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('login', 'authController@login')->name('login');
Route::post('login', 'authController@processa');
Route::get('logout', 'authController@logout')->name('logout');
