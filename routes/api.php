<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/login', 'Auth\LoginController@authenticate');

Route::post('/register', 'Auth\RegisterController@create');

Route::get('/all-galleries', 'GalleryController@index');

//Route::middleware('jwt')->get('/all-galleries', 'GalleryController@index');
Route::middleware('jwt')->get('/my-galleries', 'GalleryController@myGalleries');

Route::middleware('jwt')->get('/getUser', 'UserController@findUser');


//Route::middleware('jwt')->post('/register', 'RegisterController@create');
