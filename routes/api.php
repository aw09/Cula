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
Route::get('index-project', 'API\ProjectController@index');

Route::group(['middleware' => 'auth:api'], function(){
    //UserController
    Route::post('change-password', 'API\UserController@changePassword');
    Route::get('logout', 'API\UserController@logout');
    Route::get('get-project-user', 'API\UserController@getProject');
    Route::post('change-user-picture/{user-picture}', 'API\UserController@updatePicture');
    Route::get('get-user', 'API\UserController@getUser');

    //ProjectController
    Route::post('create-project', 'API\ProjectController@store');
    Route::get('show-project/{project}', 'API\ProjectController@show');
    Route::post('add-member-project', 'API\ProjectController@addMember');
    Route::put('update-project/{project}', 'API\ProjectController@update');
    Route::put('delete-project/{project}', 'API\ProjectController@destroy');
    Route::post('get-member-project', 'API\ProjectController@getMember');
    Route::get('myProject', 'API\ProjectController@myProject');
    Route::post('boardOfProject', 'API\ProjectController@boardOfProject');
    Route::post('delete-member-project', 'API\ProjectController@deleteMember');

    //TaskController
    Route::post('index-task', 'API\TaskController@index');
    Route::get('show-task/{task}', 'API\TaskController@show');
    Route::post('create-task', 'API\TaskController@store');
    Route::post('add-member-task', 'API\TaskController@addMember');
    Route::put('update-task/{task}', 'API\TaskController@update');
    Route::put('delete-task/{task}', 'API\TaskController@destroy');
    Route::get('roadmap', 'API\TaskController@myTask');
    Route::get('reminder', 'API\TaskController@myUrgentTask');
    Route::post('delete-member-task', 'API\TaskController@deleteMember');
    Route::post('get-member-task', 'API\TaskController@getMember');
    Route::get('myTask', 'API\TaskController@myTask'); //Roadmap
    Route::get('myUrgentTask', 'API\TaskController@myUrgentTask'); //Reminder

    //BoardController
    Route::post('index-board', 'API\BoardController@index');
    Route::post('create-board', 'API\BoardController@store');
    Route::get('show-board/{board}', 'API\BoardController@show');
    Route::post('add-member-board', 'API\BoardController@addMember');
    Route::put('update-board/{board}', 'API\BoardController@update');
    Route::put('delete-board/{board}', 'API\BoardController@destroy');
    Route::get('myBoard', 'API\BoardController@myBoard');
    Route::post('board-of-project', 'API\BoardController@boardOfProject');
    Route::post('delete-member-board', 'API\BoardController@deleteMember');

    //CardsController
    Route::post('index-card', 'API\CardsController@index');
    Route::post('create-card', 'API\CardsController@store');
    Route::get('show-card/{cards}', 'API\CardsController@show');
    Route::post('add-member-card', 'API\CardsController@addMember');
    Route::put('update-card/{cards}', 'API\CardsController@update');
    Route::put('delete-card/{cards}', 'API\CardsController@destroy');
    Route::get('myCard', 'API\CardsController@myCard');

    //GroupingController
    Route::post('create-grouping', 'API\GroupingController@store');
    Route::post('add-grouping', 'API\GroupingController@addTask');
    Route::post('list-groupinglist-grouping', 'API\GroupingController@myTask');

    //CheacklistController
    Route::post('index-checklist', 'API\CheckListController@index');
    Route::post('create-checklist', 'API\CheckListController@store');
    Route::get('show-checklist/{checklist}', 'API\CheckListController@show');
    Route::put('update-checklist/{checklist}', 'API\CheckListController@update');
    Route::put('delete-checklist/{checklist}', 'API\CheckListController@destroy');

    //CommentController
    Route::post('index-comment', 'API\CommentController@index');
    Route::post('create-comment', 'API\CommentController@store');
    Route::get('show-comment/{comment}', 'API\CommentController@show');
    Route::put('update-comment/{comment}', 'API\CommentController@update');
    Route::put('delete-comment/{comment}', 'API\CommentController@destroy');

    //LabelController
    Route::post('index-label', 'API\LabelController@index');
    Route::post('create-label', 'API\LabelController@store');
    Route::get('show-label/{label}', 'API\LabelController@show');
    Route::put('update-label/{label}', 'API\LabelController@update');
    Route::put('delete-label/{label}', 'API\LabelController@destroy');

    //LinkController
    Route::post('index-Link', 'API\LinkController@index');
    Route::post('create-Link', 'API\LinkController@store');
    Route::get('show-Link/{Link}', 'API\LinkController@show');
    Route::put('update-Link/{Link}', 'API\LinkController@update');
    Route::put('delete-Link/{Link}', 'API\LinkController@destroy');

});
