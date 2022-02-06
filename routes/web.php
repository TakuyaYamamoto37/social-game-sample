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


//Route::resource('registration', 'RegistrationController');
Route::get('registration', 'RegistrationController@Start');
Route::get('login', 'LoginController@Start');
Route::get('name', 'NameController@ChangeName');
Route::get('master_data', 'MasterDataController@Get');
Route::get('registration', 'RegistrationController@Registration');
