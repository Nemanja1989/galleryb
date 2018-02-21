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

Route::middleware('jwt')->get('/my-galleries', 'GalleryController@myGalleries');

Route::middleware('jwt')->get('/singleGallery', 'GalleryController@show');

Route::middleware('jwt')->post('/commentAdd', 'CommentController@store');
Route::middleware('jwt')->get('/loadCommentsByGallery', 'CommentController@loadCommentsByGallery');



//Route::middleware('jwt')->post('/register', 'RegisterController@create');
