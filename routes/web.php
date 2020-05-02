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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', function(){
	return redirect()->route('home');
});

Route::post('status', ['as' => 'status.post', 'uses' => 'StatusController@post']);
Route::get('post/{id}', ['as' => 'status.view', 'uses' => 'StatusController@view']);
Route::get('post/{id}/play', ['as' => 'status.play', 'uses' => 'StatusController@play']);
Route::get('status/{p}', ['as' => 'status.get', 'uses' => 'StatusController@get']);
Route::get('status/{user}/{p}', ['as' => 'status.me', 'uses' => 'StatusController@me']);
Route::post('status/{id}/like', ['as' => 'status.like', 'uses' => 'StatusController@like']);
Route::post('status/{id}/unlike', ['as' => 'status.unlike', 'uses' => 'StatusController@unlike']);
Route::delete('status/{id}/delete', ['as' => 'status.delete', 'uses' => 'StatusController@destroy']);
Route::patch('status/{id}/edit', ['as' => 'status.edit', 'uses' => 'StatusController@update']);
Route::patch('status/{id}/public', ['as' => 'status.public', 'uses' => 'StatusController@setpublic']);
Route::post('status/{id}/restore', ['as' => 'status.restore', 'uses' => 'StatusController@restore']);

Route::post('report', ['as' => 'report.post', 'uses' => 'ReportController@post']);
Route::get('reports', ['as' => 'report.list', 'uses' => 'ReportController@list_report']);
Route::delete('reports', ['as' => 'report.destroy', 'uses' => 'ReportController@destroy_report']);

Route::get('friends', ['as' => 'users.friends', 'uses' => 'UsersController@friends']);
Route::post('friends', ['as' => 'friends.forgif', 'uses' => 'FriendsController@forgif']);
Route::patch('friends', ['as' => 'friends.confirm', 'uses' => 'FriendsController@confirm']);
Route::delete('friends', ['as' => 'friends.destroy', 'uses' => 'FriendsController@destroy']);
Route::get('help/contact', ['as' => 'pages.contact', 'uses' => 'PagesController@contact']);
Route::get('help/{slug}', ['as' => 'pages.view', 'uses' => 'PagesController@view']);
Route::get('help', ['as' => 'help', 'uses' => 'PagesController@help']);
Route::get('pages', ['as' => 'pages', 'uses' => 'PagesController@index']);
Route::post('pages', ['as' => 'pages.create', 'uses' => 'PagesController@store']);
Route::get('pages/{id}/edit', ['as' => 'pages.edit', 'uses' => 'PagesController@edit']);
Route::patch('pages/{id}/edit', ['as' => 'pages.update', 'uses' => 'PagesController@update']);
Route::get('pages/{id}/delete', ['as' => 'pages.delete', 'uses' => 'PagesController@delete']);
Route::delete('pages/{id}/delete', ['as' => 'pages.destroy', 'uses' => 'PagesController@destroy']);

Route::get('settings', ['as' => 'users.settings', 'uses' => 'UsersController@settings']);
Route::patch('settings', ['as' => 'users.update', 'uses' => 'UsersController@update']);
Route::get('picture', ['as' => 'users.picture', 'uses' => 'UsersController@picture']);
Route::patch('picture', ['as' => 'users.picture_update', 'uses' => 'UsersController@picture_update']);
Route::get('cover', ['as' => 'users.cover', 'uses' => 'UsersController@cover']);
Route::patch('cover', ['as' => 'users.cover_update', 'uses' => 'UsersController@cover_update']);
Route::get('search', ['as' => 'users.search', 'uses' => 'UsersController@search']);
Route::get('users/activate/{id}', ['as' => 'users.activate', 'uses' => 'UsersController@activate']);
Route::get('{req}/forgifings', ['as' => 'users.forgifings', 'uses' => 'UsersController@forgifings']);
Route::get('{req}/forgifers', ['as' => 'users.forgifers', 'uses' => 'UsersController@forgifers']);
Route::get('{req}', ['as' => 'users.detail', 'uses' => 'UsersController@detail']);

Route::group(['prefix' => 'login'], function() {
	
	Route::get('{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
	Route::get('{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

});


Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function() {

});
