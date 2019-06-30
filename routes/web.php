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
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/companies', 'CompanyController@index');
Route::get('/companies/{company}', 'CompanyController@show');
Route::post('/companies', 'CompanyController@store');
Route::patch('/companies/{company}', 'CompanyController@update');
Route::delete('/companies/{company}', 'CompanyController@destroy');

Route::get('/users', 'UserController@index');
Route::get('/users/{user}', 'UserController@show');
Route::post('/users', 'UserController@store');
Route::patch('/users/{user}', 'UserController@update');
Route::delete('/users/{user}', 'UserController@destroy');

Route::get('/employees', 'EmployeeController@index');
Route::get('/employees/{employee}', 'EmployeeController@show');
Route::post('/employees', 'EmployeeController@store');
Route::patch('/employees/{employee}', 'EmployeeController@update');
Route::delete('/employees/{employee}', 'EmployeeController@destroy');


