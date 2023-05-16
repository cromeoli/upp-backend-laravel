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

// User
//Route group /api/user
Route::group(['prefix' => 'user'], function () {
    Route::post("/login", "App\Http\Controllers\UserController@login");
    Route::post("/register", "App\Http\Controllers\UserController@register");
    // group the middleware routes
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post("/logout", "App\Http\Controllers\UserController@logout");
        Route::put("/modifyUser", "App\Http\Controllers\UserController@modifyUser");
        Route::get("/getUser", "App\Http\Controllers\UserController@getUser");
        Route::get("/users", "App\Http\Controllers\UserController@getAllUsers");
        Route::delete("/deleteUser", "App\Http\Controllers\UserController@deleteUser");
    });
});

// Circle
//Route group /api/circle
Route::group(['prefix' => 'circle'], function () {
    Route::get("/circles", "App\Http\Controllers\CircleController@getAllCircles");
    Route::get("/circle/{id}", "App\Http\Controllers\CircleController@getCircle");
    // group the middleware routes
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post("/createCircle", "App\Http\Controllers\CircleController@createCircle");
        Route::put("/modifyCircle/{id}", "App\Http\Controllers\CircleController@modifyCircle");
        Route::delete("/deleteCircle", "App\Http\Controllers\CircleController@deleteCircle");
    });
});

// CircleHasUser
//Route group /api/circleHasUser
Route::group(['prefix' => 'circleHasUser'], function () {
    Route::get("/getCircles", "App\Http\Controllers\CircleHasUserController@getCircles");
    Route::get("/getUsers", "App\Http\Controllers\CircleHasUserController@getUsers");
    // group the middleware routes
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post("/addUser", "App\Http\Controllers\CircleHasUserController@addUser");
        Route::delete("/removeUser", "App\Http\Controllers\CircleHasUserController@removeUser");
    });
});
