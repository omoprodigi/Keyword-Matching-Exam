<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('admin/login', ['as' => 'admin/login', 'uses' => 'AdminController@login']);
Route::post('admin/auth', ['as' => 'admin/auth', 'uses' => 'AdminController@auth']);
Route::post('admin/dashboard', ['as' => 'admin/dashboard', 'uses' => 'AdminController@dashboard']);


Route::get('lecturer/login', ['as' => 'lecturer/login', 'uses' => 'LecturerController@login']);
Route::post('lecturer/auth', ['as' => 'lecturer/auth', 'uses' => 'LecturerController@auth']);

Route::get('student/login', ['as' => 'student/login', 'uses' => 'StudentController@login']);
Route::post('student/auth', ['as' => 'student/auth', 'uses' => 'StudentController@auth']);



Route::get('exam/take/{id}', ['as' => 'exam.take', 'uses' => 'ExaminationController@take']);




Route::resource('faculty', 'FacultyController');
Route::resource('course', 'CourseController');
Route::resource('lecturer', 'LecturerController');
Route::resource('student', 'StudentController');
Route::resource('exam', 'ExaminationController');
Route::resource('question', 'QuestionController');
Route::resource('department', 'DepartmentController');
Route::resource('registration', 'RegistrationController');
Route::resource('home', 'HomeController');
Route::resource('admin', 'AdminController');

Route::controllers([ 
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);




Route::get('/', function () {
    return view('home/index');
});
