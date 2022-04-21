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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['name' => 'Home'], function (){
    Route::get('register', 'Api\UserApiController@register');
    Route::post('registerUser', 'Api\UserApiController@registerUser');
    Route::post('message', 'Api\MessageApiController@message');
    Route::post('checkMail', 'Api\UserApiController@emailCheck');
    Route::post('userLogin', 'Api\UserApiController@userLogin');
    Route::get('sendVerifyEmail', 'Api\UserApiController@emailVerification');
    Route::post('verifyMail', 'Api\UserApiController@emailVerify');
    Route::get('careerOpportunities', 'Api\CareerApiController@job');
    Route::post('apply', 'Api\CareerApiController@jobApplication');
    Route::get('loginToken', 'Api\UserApiController@fetchToken');
});

Route::group(['name' => 'Home', 'middleware' => 'auth:api'], function (){
    Route::post('userDetails', 'Api\RegistrationController@userDetails');
    Route::post('refreshLogin', 'Api\RegistrationController@refreshLogin');
    Route::get('staffType', 'Api\BookingApiController@staffType');
    Route::post('bookStaff', 'Api\BookingApiController@BookingCreate');
    Route::get('me', 'Api\RegistrationController@me');
});
