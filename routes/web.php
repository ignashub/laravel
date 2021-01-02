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

Route::get('/', 'PageController@index');

Route::resource('posts', 'PostController');
Auth::routes();

Route::get('/home', 'DashboardController@index')->name('home');
Route::resource('users', 'Useredit');
Route::get('/create', 'PostController@create');
Auth::routes();
Route::patch('profile/{user}/update',  ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
Route::post('profile/{user}/updatePic', 'Useredit@update_avatar');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/post_pdf/{id}', 'PostController@generate_pdf')->name('pdf');
Route::get('/admin', 'Useredit@show_all')->name('admin');
Route::get('/export', 'Useredit@export');

