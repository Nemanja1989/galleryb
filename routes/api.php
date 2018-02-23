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

// not logged user can see
Route::get('/singleGallery', 'GalleryController@show');
Route::get('/loadGalleries', 'GalleryController@loadGalleries');

Route::middleware('jwt')->delete('/removeGallery/{id}', 'GalleryController@destroy');
Route::middleware('jwt')->post('/galleries', 'GalleryController@store');
Route::middleware('jwt')->put('/galleries', 'GalleryController@update');

//comments
Route::middleware('jwt')->delete('/removeComment/{id}', 'CommentController@destroy');
Route::middleware('jwt')->post('/commentAdd', 'CommentController@store');
Route::get('/loadCommentsByGallery', 'CommentController@loadCommentsByGallery');

Route::middleware('jwt')->get('/getUser', 'UserController@findUser');


