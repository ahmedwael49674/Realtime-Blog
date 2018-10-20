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
//any one can see the comments
Route::get('posts/{post}/comments','CommentController@index');


//only user can add comment
Route::middleware('auth:api')->group(function () {
//Route::post('posts/{post}/comments','CommentController@index'); //jwt test
Route::post('posts/{post}/comment','CommentController@store');
});
