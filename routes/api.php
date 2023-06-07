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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/types", "App\Http\Controllers\TypesController@getAllTypes")->middleware('auth:sanctum');

////////////////////////// User
//Route group /api/user
Route::group(['prefix' => 'user'], function () {
    Route::post("/login", "App\Http\Controllers\UserController@login");
    Route::post("/register", "App\Http\Controllers\UserController@register");
    Route::get("/checkNickname/{nickname}", "App\Http\Controllers\UserController@getUserByNickname");
    Route::get("/checkEmail/{email}", "App\Http\Controllers\UserController@getUserByEmail");
    Route::get("/usersByCircle/{id}", "App\Http\Controllers\UserController@getUsersByCircle");

    // group the middleware routes
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post("/logout", "App\Http\Controllers\UserController@logout");
        Route::put("/modifyUser", "App\Http\Controllers\UserController@modifyUser");
        Route::get("/getUser", "App\Http\Controllers\UserController@getUser");
        Route::get("/users", "App\Http\Controllers\UserController@getAllUsers");
        Route::delete("/deleteUser", "App\Http\Controllers\UserController@deleteUser");
    });
});

//////////////////////// Circle
//Route group /api/circle
Route::group(['prefix' => 'circle'], function () {
    Route::get("/circles", "App\Http\Controllers\CircleController@getAllCircles");
    Route::get("/circle/{id}", "App\Http\Controllers\CircleController@getCircle");
    // group the middleware routes
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post("/createCircle", "App\Http\Controllers\CircleController@createCircle");
        Route::put("/modifyCircle/{id}", "App\Http\Controllers\CircleController@modifyCircle");
        Route::delete("/deleteCircle", "App\Http\Controllers\CircleController@deleteCircle");
        Route::get("/myCircles", "App\Http\Controllers\CircleHasUserController@getMyCircles");
        Route::post("/joinCircle/{id}", "App\Http\Controllers\CircleHasUserController@joinCircle");
        Route::delete("/leaveCircle/{id}", "App\Http\Controllers\CircleHasUserController@leaveCircle");
        Route::get("/createdCircles", "App\Http\Controllers\CircleController@getCreatedCircles");
    });
});

//////////////////////// Post
/// Route group URL --->  /api/post
Route::group(['prefix' => 'post'], function () {
    Route::get("/posts", "App\Http\Controllers\PostController@getAllPosts");
    Route::get("/post/{id}", "App\Http\Controllers\PostController@getPost");
    Route::get("/postsByCircle/{id}", "App\Http\Controllers\PostController@getPostsByCircle");
    // group the middleware routes
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post("/createPost", "App\Http\Controllers\PostController@createPost");
        Route::delete("/deletePost/{id}", "App\Http\Controllers\PostController@deletePost");
    });
});

