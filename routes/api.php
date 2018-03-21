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
//For can signup and signin for clients. 
Route::post('/client',['uses'=>"AuthController@signup"]);
Route::post('/client/signin',['uses'=>"AuthController@signin"]);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//get identical patient
Route::get('/getPatient/{id}',['uses'=>'PatientController@getPatient']); 
//get patients of a day
Route::get('/getPatients/{date}',['uses'=>'PatientController@getPatients']);
//get data of user who login
Route::get('/client/getAuthUser',['uses'=>'AuthController@getAuthUser']);
//add reservation
Route::post('/addReservation',['uses'=>'ReservationController@addReservation']);
//retrieve Patients of Today
Route::get('/getPatientsToday',['uses'=>'PatientController@getPatientsToday']);
//edit  patient
Route::post('/updatePatient',['uses'=>'PatientController@update']);
Route::post('/updateReservation',['uses'=>'ReservationController@update']);
Route::delete('/deleteReservation/{reservation_id}/{patient_id}',['uses'=>'ReservationController@destroy']);
Route::get('/reservationDetails/{id}',['uses'=>'ReservationController@reservationDetails']);
Route::post('/addSecretary',['uses'=>'DoctorController@addSecretary']);




