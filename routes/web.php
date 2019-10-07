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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/emails', function () {
    return view('emials');
})->middleware('auth');


Route::get('/state_emails', function () {

    $jobs = Jobs::all(();

    // Jobs
    return view('state_emails', compact('jobs'));
})->middleware('auth');






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
