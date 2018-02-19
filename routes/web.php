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
    return view('teams');
});

Route::get('/', 'TeamsController@index')->name('teams');

Route::get('/teams', 'TeamsController@index')->name('teams');

//mora biti iznad id
Route::get('/teams/create', 'TeamsController@create')->name('createTeam');
Route::post('/teams/store', 'TeamsController@store')->name('storeTeam');

Route::get('/teams/{id}', 'TeamsController@show')->name('team');




