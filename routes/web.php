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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index');
    Route::resource('doctors', 'DoctorsController');
    Route::resource('patients', 'PatientsController');
    Route::resource('pharmacy', 'PharmacyController');
    Route::resource('rooms', 'RoomsController');
    Route::resource('appointments', 'AppointmentController');
    Route::post('patients/search', 'SearchController@patients');
    Route::post('appointments/search', 'SearchController@appointments');
    Route::post('pharmacy/search', 'SearchController@pharmacy');
    Route::post('doctors/search', 'SearchController@doctors');
});

Route::get('{id}/pay', 'HomeController@pay');
Route::post('/checkout', 'HomeController@checkout');
