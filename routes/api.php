<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return 'Welcome to the Promote-API!';
})->name('welcome-api');

Route::group(['prefix' => 'post'], function () {
    Route::get('{post}/comments', 'CommentController@index');

    Route::group(['middleware' => 'auth'], function () {
        Route::post('{post}/comment', 'CommentController@store');
        Route::delete('{post}/comment/{comment}/', 'CommentController@destroy');
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::get('{user}/comments', 'UserController@comments')->middleware('auth');
    Route::get('{user}/notifications', 'UserController@notifications');
});
