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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('authors', 'Api\UserController@index');
Route::get('author/{id}', 'Api\UserController@show');
Route::get('posts/author/{id}', 'Api\UserController@GetAuthorPosts');
Route::get('comments/author/{id}', 'Api\UserController@GetAuthorComments');

Route::get('categories', 'Api\CategoryController@index');
Route::get('posts/categories/{id}', 'Api\CategoryController@GetCategoryPosts');
Route::get('posts', 'Api\PostController@index');
Route::get('post/{id}', 'Api\PostController@show');
Route::get('comments/post/{id}', 'Api\PostController@GetPostComments');