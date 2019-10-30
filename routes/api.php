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
Route::post('create-project', 'API\ProjectController@store');
Route::post('add-member-project', 'API\ProjectController@addMember');
Route::put('update-project/{project}', 'API\ProjectController@update');
Route::put('delete-project/{project}', 'API\ProjectController@destroy');
Route::post('create-board', 'API\BoardController@store');
Route::post('add-member-board', 'API\BoardController@addMember');
Route::put('update-board/{board}', 'API\BoardController@update');
Route::put('delete-board/{board}', 'API\BoardController@destroy');
Route::post('create-card', 'API\CardsController@store');
Route::post('add-member-card', 'API\CardsController@addMember');
Route::put('update-card/{board}', 'API\CardsController@update');
Route::put('delete-card/{board}', 'API\CardsController@destroy');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::post('changePassword', 'API\UserController@changePassword');
});
