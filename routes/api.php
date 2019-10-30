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
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::get('token', 'API\UserController@getToken');

Route::get('index-project', 'API\ProjectController@index');
Route::post('create-project', 'API\ProjectController@store');
Route::get('show-project/{project}', 'API\ProjectController@show');
Route::post('add-member-project', 'API\ProjectController@addMember');
Route::put('update-project/{project}', 'API\ProjectController@update');
Route::put('delete-project/{project}', 'API\ProjectController@destroy');

Route::get('index-board', 'API\BoardController@index');
Route::post('create-board', 'API\BoardController@store');
Route::get('show-board/{board}', 'API\BoardController@show');
Route::post('add-member-board', 'API\BoardController@addMember');
Route::put('update-board/{board}', 'API\BoardController@update');
Route::put('delete-board/{board}', 'API\BoardController@destroy');

Route::get('index-card', 'API\CardsController@index');
Route::post('create-card', 'API\CardsController@store');
Route::get('show-card/{cards}', 'API\CardsController@show');
Route::post('add-member-card', 'API\CardsController@addMember');
Route::put('update-card/{cards}', 'API\CardsController@update');
Route::put('delete-card/{cards}', 'API\CardsController@destroy');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::post('change-password', 'API\UserController@changePassword');
});
