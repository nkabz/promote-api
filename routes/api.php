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

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('{post}/comment', 'CommentController@store');
        Route::delete('{post}/comment/{comment}/', 'CommentController@destroy');
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::get('{user}/comments', 'UserController@comments');

    Route::post('login', 'Auth\AuthController@login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('notifications', 'UserController@notifications');
        Route::post('coins', 'UserController@buyCoins');
    });
});
