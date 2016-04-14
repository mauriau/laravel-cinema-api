<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('personnel', 'PersonnelController');
Route::resource('fonction', 'FonctionController');
Route::resource('reduction', 'ReductionController');
Route::resource('film', 'FilmController');
Route::resource('salle', 'SalleController');
Route::resource('distributeur', 'DistribtueurController');