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

Route::resource('patients', 'PatientController');
Route::post('patients/addTraining', 'PatientController@addTraining');
Route::get('patients/hasFeedback/{id}', 'PatientController@hasFeedback');
Route::get('patients/getFeedback/{id}', 'PatientController@getFeedback');
Route::get('patients/hasCrqsas/{id}', 'PatientController@hasCrqsas');
Route::get('patients/getCrqsas/{id}', 'PatientController@getCrqsas');
Route::get('patients/getCat/{id}', 'PatientController@hasCat');
Route::get('patients/hasCat/{id}', 'PatientController@getCat');
Route::get('patients/getGehtest/{id}', 'PatientController@hasGehtest');
Route::get('patients/hasGehtest/{id}', 'PatientController@getGehtest');

Route::resource('arp_fragebogen', 'ArpFeedbackController');
Route::resource('crq_sas', 'CrqsasController');
Route::resource('cat', 'CatController');
Route::resource('gehtest', 'GehtestController');

Route::resource('trainings', 'TrainingController');
Route::get('trainings/{id}/getParticipants', 'TrainingController@getParticipants');