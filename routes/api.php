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
Route::post('loginGetMember', 'API\UserController@loginGetMember');
Route::post('register', 'API\UserController@register');
// Route::get('index-project', 'API\ProjectController@index');

Route::group(['middleware' => 'auth:api'], function(){
    //UserController
    Route::post('change-password', 'API\UserController@changePassword');
    Route::get('logout', 'API\UserController@logout');
    Route::get('get-project-user', 'API\UserController@getProject');
    Route::post('change-user-picture/{user-picture}', 'API\UserController@updatePicture');
    Route::get('get-user', 'API\UserController@getUser');

    //ProjectController
    Route::resource('project', 'API\ProjectController');
    Route::post('project/member/', 'API\ProjectController@addMember');
    Route::get('project/member', 'API\ProjectController@getMember');
    Route::delete('project/member/{user}', 'API\ProjectController@deleteMember');
    Route::get('myProject', 'API\ProjectController@myProject');
    Route::post('boardOfProject', 'API\ProjectController@boardOfProject');

    //TaskController
    Route::resource('task', 'API\TaskController');
    Route::post('task/member/{user}', 'API\TaskController@addMember');
    Route::get('task/member', 'API\TaskController@getMember');
    Route::delete('task/member/{user}', 'API\TaskController@deleteMember');
    Route::get('roadmap', 'API\TaskController@myTask');
    Route::get('reminder', 'API\TaskController@myUrgentTask');
    Route::get('myTask', 'API\TaskController@myTask'); //Roadmap
    Route::get('myUrgentTask', 'API\TaskController@myUrgentTask'); //Reminder

    //BoardController
    Route::resource('board', 'API\BoardController');
    Route::post('board/member', 'API\BoardController@addMember');
    Route::get('board/member', 'API\BoardController@getMember');
    Route::delete('board/member/{user}', 'API\BoardController@deleteMember');
    Route::get('myBoard', 'API\BoardController@myBoard');
    Route::post('board-of-project', 'API\BoardController@boardOfProject');

    //CardsController
    Route::resource('card', 'API\CardsController');
    Route::post('card/member', 'API\CardsController@addMember');
    Route::get('card/member', 'API\CardsController@getMember');
    Route::delete('card/member/{user}', 'API\CardsController@deleteMember');
    Route::get('myCard', 'API\CardsController@myCard');

    //GroupingController
    Route::resource('grouping', 'API\GroupingController');
    Route::post('add-grouping', 'API\GroupingController@addTask');
    Route::post('list-groupinglist-grouping', 'API\GroupingController@myTask');

    //CheacklistController
    Route::resource('checklist', 'API\CheckListController');

    //CommentController
    Route::resource('comment', 'API\CommentController');

    //LabelController
    Route::resource('label', 'API\LabelController');

    //LinkController
    Route::resource('link', 'API\LinkController');

});
