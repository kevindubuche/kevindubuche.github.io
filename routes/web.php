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
Route::group(['middleware' => ['admin']], function () {
    Route::resource('admin', 'AdminController');
    Route::resource('hospital', 'HospitalController');
    //export csv
    Route::post('download-csv-patients', 'PatientController@exportCsv')->name('download-csv-patients');
    Route::get('patientscsv', 'PatientController@indexcsv')->name('patientscsv');
    Route::get('patients_set_up_csv', 'PatientController@patients_set_up_csv')->name('patients_set_up_csv');
    //fullcalender
    Route::get('fullcalendar','FullCalendarController@index');
    Route::post('fullcalendar/create','FullCalendarController@create');
    Route::post('fullcalendar/update','FullCalendarController@update');
    Route::post('fullcalendar/delete','FullCalendarController@destroy');

});

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('patients', 'PatientController');
Route::post('/fichePatient','PatientController@fichePatient')->name('fichePatient');
Route::post('/downloadPDF','PatientController@createPDF')->name('downloadPDF');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/sendEmail','ContactController@sendEmail')->name('sendEmail');

