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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/residuos', 'ResiduosController@index');
Route::post('/residuos/import', 'ResiduosController@import');
Route::put('/residuos/update/{id}', 'ResiduosController@update');
Route::delete('/residuos/delete/{id}', 'ResiduosController@destroy');
