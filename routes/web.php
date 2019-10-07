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

use App\Jobs;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/emails', function () {
    return view('emials');
})->middleware('auth');


Route::get('/state_emails', function () {
    return view('emails.state_emails');
})->middleware('auth');


// Grupo de rutas protegidas por un middleware, para que solo puedan acceder los usuarios autenticados
Route::group(['middleware' => 'auth', 'prefix' => 'api'], function () {
    Route::post('queuedEmail', 'EmailController@queuedEmail');
    Route::get('getUsers', 'UserController@getUsers');
    Route::get('getCountries', 'CountryController@getCountries');
    Route::post('saveUser', 'UserController@saveUser');
    Route::post('editUser', 'UserController@editUser');
    Route::post('deleteUser', 'UserController@deleteUser');
    Route::get('getEmails', 'EmailController@getEmails');
});




Route::get('/view_email', 'Emal@index')->name('home');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
