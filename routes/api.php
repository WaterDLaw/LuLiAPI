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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

    
});
*/
Route::middleware('jwt.auth')->get('users', function(Request $request) {
    return auth()->user();
});

Route::post('user/register', 'UserController@register');
Route::post('user/login', 'UserController@login');
Route::get('user/loggedIn/{email}', 'UserController@getUserByEmail');
Route::get('user/all', 'UserController@getAllUsers');
Route::put('user/{id}', 'UserController@update');
Route::get('user/{id}', 'UserController@getSingleUser');

Route::resource('patients', 'PatientController');
Route::post('patients/addTraining', 'PatientController@addTraining');
Route::get('patients/hasFeedback/{id}', 'PatientController@hasFeedback');
Route::get('patients/getFeedback/{id}', 'PatientController@getFeedback');
Route::get('patients/hasCrqsasBefore/{id}', 'PatientController@hasCrqsasBefore');
Route::get('patients/hasCrqsasAfter/{id}', 'PatientController@hasCrqsasAfter');
Route::get('patients/getCrqsas/{id}', 'PatientController@getCrqsas');
Route::get('patients/getCat/{id}', 'PatientController@getCat');
Route::get('patients/hasCatBefore/{id}', 'PatientController@hasCatBefore');
Route::get('patients/hasCatAfter/{id}', 'PatientController@hasCatAfter');
Route::get('patients/getGehtest/{id}', 'PatientController@getGehtest');
Route::get('patients/hasGehtestBefore/{id}', 'PatientController@hasGehtestBefore');
Route::get('patients/hasGehtestAfter/{id}', 'PatientController@hasGehtestAfter');


Route::resource('arp_fragebogen', 'ArpFeedbackController');
Route::resource('crq_sas', 'CrqsasController');
Route::resource('cat', 'CatController');
Route::resource('gehtest', 'GehtestController');

Route::resource('entry', 'EntryController');
Route::get('patients/{id}/entries', 'EntryController@getEntries');

Route::resource('trainings', 'TrainingController');
Route::get('calendar', 'TrainingController@getCalendar');
Route::get('trainings/{id}/getParticipants', 'TrainingController@getParticipants');

Route::resource('pneumologist','PneumologistController');
Route::get('pneumologist/{id}/getPatients', 'PneumologistController@getPatients');

Route:: reasource('actionhistory'. 'ActionHistoryController');

Route::get('statistics', 'StatisticController@getPatientsWithTrainings');

Route::get('pdf/Verordnung/{id}', 'PdfController@getVerordnungsformular');
