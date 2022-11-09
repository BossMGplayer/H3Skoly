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

// Schools
Route::get('/manageSchools', function () {
    return view('manageSchools');
});

Route::get('/allSchools', function () {
    return view('allSchools');
});

// Fields
Route::get('/manageFields', function () {
    return view('manageFields');
});

Route::get('/allFields', function () {
    return view('allFields');
});

// Subjects
Route::get('/manageSubjects', function () {
    return view('manageSubjects');
});

Route::get('/allSubjects', function () {
    return view('allSubjects');
});

// Lunches
Route::get('/manageLunches', function () {
    return view('manageLunches');
});

Route::get('/allLunches', function () {
    return view('allLunches');
});

// Subject Ratings
Route::get('/manageRatings', function () {
    return view('manageSubjectRatings');
});

Route::get('/allRatings', function () {
    return view('allSubjectRatings');
});

// Lunch Ratings
Route::get('/manageLunchRatings', function () {
    return view('manageLuncheRatings');
});

Route::get('/allLunchRatings', function () {
    return view('allLunchRatings');
});


// Experiment
Route::delete('school-delete', [\App\Http\Controllers\SchoolsController::class, 'destroy']);

