<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\FieldsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\LunchesController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\LunchRatingController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::resource('schools', SchoolsController::class);
Route::resource('fields', FieldsController::class);
Route::resource('subjects', SubjectsController::class);
Route::resource('lunches', LunchesController::class);
Route::resource('subjects.ratings', RatingController::class);
Route::resource('lunches.ratings', LunchRatingController::class);
