<?php

use Illuminate\Http\Request;

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



Route::get('getUsers', 'UserController@getUsers');
Route::get('getCountries', 'CountryController@getCountries'); //saveUser
Route::post('saveUser', 'UserController@saveUser'); //saveUser
Route::post('editUser', 'UserController@editUser'); //saveUser
Route::post('deleteUser', 'UserController@deleteUser'); //saveUser
Route::post('queuedEmail', 'EmailController@queuedEmail'); //saveUser



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
