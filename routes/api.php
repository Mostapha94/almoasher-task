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

//categories
Route::get('/categories',[App\Http\Controllers\Api\CategoryController::class,'index']);
Route::get('/category/{id}',[App\Http\Controllers\Api\CategoryController::class,'show']);

//courses
Route::get('/courses',[App\Http\Controllers\Api\CourseController::class,'index']);
Route::get('/course/{id}',[App\Http\Controllers\Api\CourseController::class,'show']);

