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

Route::resource('personne', 'PersonneController');
Route::resource('fonction', 'FonctionController');
Route::resource('reduction', 'ReductionController');
Route::resource('film', 'FilmController');
Route::resource('membre', 'MembreController');
Route::resource('abonnement', 'AbonnementController');
Route::resource('salle', 'SalleController');
Route::resource('distributeur', 'DistributeurController');
Route::resource('genre', 'GenreController');
Route::get('personne/{id_personne}/fonctions', [
    'as' => 'personneWithFonctions', 'uses' => 'PersonneController@getFonctions'
]);

Route::get('fonction/{id_fonction}/personnes', [
    'as' => 'fonctionWithPersonnes', 'uses' => 'FonctionController@getPersonnes'
]);
Route::post('authenticate', [
    'as' => 'authenticate', 'uses' => 'JWTController@authenticate'
]);

Route::post('hashPassword', [
    'as' => 'hashPassword', 'uses' => 'JWTController@hashPassword'
]);