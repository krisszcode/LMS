<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Auth::routes();

/*
 Home
*/
Route::get('/', function () {
    return redirect("/index");
});

Route::get('/index', 'HomeController@index')->name('index');

/*
 User(s)
*/
Route::get('/users', 'UserController@show')->name('users.show');
Route::get('/{user}/scores','UserScoreController@index')->name('userScore.index');

/*
 Submission(s)
*/
Route::get('/submissions', 'SubmissionController@index')->name('submissions.index');//mentor access
Route::post('/submission/{submission}/grade','SubmissionController@update');


/*
 Curriculum
*/
Route::get('/curriculum/create','PageController@create')->name('curriculum.create'); //mentor access
Route::get('/curriculum/index', 'PageController@index') ->name('curriculum.index');
Route::post('/curriculum','PageController@store');

/*
 Text page
*/
Route::get('/textpage/{textpage}','PageController@view')->name('curriculum.view'); //mentor access
Route::post('/textpage/{textpage}/edit', 'PageController@edit'); //mentor access

/*
 Assignment
 */
Route::get('/assignment/create','AssignmentController@create')->name('assignment.create'); //mentor access
Route::get('/assignment/index', 'AssignmentController@index') ->name('assignment.index');
Route::post('/assignment','AssignmentController@store');
Route::get('/assignment/{assignment}','AssignmentController@view')->name('assignment.view'); //mentor access

Route::post('/assignment','AssignmentController@store');
Route::post('/assignment/{assignment}/edit', 'AssignmentController@edit');
Route::post('/assignment/{assignment}/submit','AssignmentController@submitAnswer');

/*
 Profile
*/
Route::get('/profile/{user}','ProfileController@show')->name('profile.show');
Route::get('/profile/{user}/edit','ProfileController@edit')->name('profile.edit');
Route::post('/profile/{user}/update','ProfileController@update');

/*
 Attendance
*/
Route::get('/attendance', 'AttendanceController@index')->name('attendance.index'); //mentor access
Route::post('/attendance/store', 'AttendanceController@store');
Route::post('/attendance/date', 'AttendanceController@getDate');
