<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/profile', 'App\Http\Controllers\ProfileController@show');
    Route::post('/create-post', 'App\Http\Controllers\PostController@create');
    Route::get('/show-posts', 'App\Http\Controllers\PostController@index');
    Route::get('/post-detail/{id}', 'App\Http\Controllers\PostController@show');
    Route::post('/update-post/{id}', 'App\Http\Controllers\PostController@update');
    Route::delete('/delete-post/{id}', 'App\Http\Controllers\PostController@destroy');
    Route::get('/user-detail/{id}', 'App\Http\Controllers\AuthController@show');
    Route::post('/update-profile/{id}', 'App\Http\Controllers\AuthController@update');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
});

Route::post('login', 'App\Http\Controllers\AuthController@login');
