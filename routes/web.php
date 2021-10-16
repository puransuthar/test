<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/user-profile', 'ProfileController@index')->middleware('auth');
Route::post('/user-profile/update', 'ProfileController@update')->middleware('auth');


// Student related routes
Route::get('/students/fetch', 'StudentController@fetch');
Route::resource('students', 'StudentController');