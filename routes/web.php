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
Route::get('login', 'LoginController@Login');
Route::get('name', 'NameController@ChangeName');
Route::get('master_data', 'MasterDataController@Get');
Route::get('registration', 'RegistrationController@Registration');
Route::get('quest_tutorial', 'QuestController@Tutorial');
Route::get('quest_start', 'QuestController@Start');
Route::get('quest_end', 'QuestController@End');
Route::get('character', 'CharacterController@GetCharacterList');
Route::get('character_sell', 'CharacterController@SellCharacter');
Route::get('gacha', 'GachaController@DrawGacha');
Route::get('shop', 'ShopController@BuyItem');
Route::get('present_list', 'PresentController@GetPresentList');
Route::get('present', 'PresentController@GetItem');