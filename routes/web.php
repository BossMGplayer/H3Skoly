<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/manageSchools', function () {
    return view('manageSchools');
});

Route::get('/allSchools', function () {
    return view('allSchools');
});

Route::delete('school-delete', [\App\Http\Controllers\SchoolsController::class, 'destroy']);

