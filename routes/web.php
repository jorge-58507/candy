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

Route::get('/', function (Request $request) {
        return view('welcome');
})->middleware('guest')->name('index');

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

// Route::post('log_medic', [
//     'uses' => 'logmedicController@log'
// ]);
// Route::get('/configuration', function () {
//     return view('configuration.index');
// });

Route::get('/verify_identification/{patient_ci}', 'patientController@get_patient_by_ci')->middleware('auth');;
Route::get('/verify_historynumber/{history_number}', 'patientController@get_patient_by_history')->middleware('auth');;
Route::get('/patient/last/', 'patientController@get_next_history')->middleware('auth');;
// Route::get('/patient_id_by_history/{num_history}', 'patientController@get_patient_by_history');
Route::get('/reason_id_by_value/{reason_value}', 'reasonController@get_reason_by_value')->middleware('auth');;
Route::get('/filter_date_by_date/{date}', 'dateController@filter_date_by_date')->middleware('auth');;
// Route::get('/drug_info/{drug_id}', 'requestController@new_preescription');

// PRINTS
// Route::get('/print_lab/{date_slug}', 'printController@print_history_laboratory');
// Route::get('/print_report/{date_slug}', 'printController@print_history_report');
// Route::get('/print_medicalorder/{date_slug}', 'printController@print_history_medicalorder');
// Route::get('/print_constancy/{date_slug}', 'printController@print_document_constancy');
// Route::get('/print_incapacity/{date_slug}', 'printController@print_document_incapacity');

Route::post('/save_sidenav_patient', 'patientController@store');
// Route::post('/save_sidenav_reason', 'requestController@save_sidenav_reason');
// Route::post('/save_frecuency_dose','drugController@new_frecuency_dose');
// Route::post('/drug_dose','drugController@save_dose');
// Route::post('/drug_frecuency','drugController@save_frecuency');
Route::post('/logmedic','medicController@log');

// Route::put('/date/{abc}','dateController@update');

// Route::delete('/drug_dose/delete', 'drugController@delete_dose');
// Route::delete('/drug_frecuency/delete', 'drugController@delete_frecuency');

// Route::get('/treatment_drugpicked/{slug}', 'treatmentController@drugpicked');


// Route::resource('log_medic', 'logmedicController');
// Route::get('admin/profile', ['middleware' => 'mw_CheckLogin','uses' => 'authController@index']);
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('auth', 'authController');
Route::resource('medic', 'medicController');
Route::resource('date', 'dateController')->middleware('auth');
Route::resource('configuration', 'configurationController')->middleware('auth');
Route::resource('patient', 'patientController')->middleware('auth');
Route::resource('reason', 'reasonController')->middleware('auth');
Route::resource('history', 'historyController')->middleware('auth');
// Route::resource('order', 'orderController',['middleware' => 'mw_CheckLogin']);
// Route::resource('document', 'documentController',['middleware' => 'mw_CheckLogin']);
// Route::resource('drug', 'drugController',['middleware' => 'mw_CheckLogin']);
// Route::resource('treatment', 'treatmentController',['middleware' => 'mw_CheckMedic']);
