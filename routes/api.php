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

