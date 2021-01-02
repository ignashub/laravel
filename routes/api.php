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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('api_posts', 'PostAPIController@getAllPosts');
Route::get('api_posts/{id}', 'PostAPIController@getPost');
Route::post('api_posts', 'PostAPIController@createPost');
Route::put('api_posts/{id}', 'PostAPIController@updatePost');
Route::delete('api_posts/{id}','PostAPIController@deletePost');
