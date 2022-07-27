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
    Route::post('sendVerifyEmail', 'Api\UserApiController@emailVerification');
    Route::post('verifyMail', 'Api\UserApiController@emailVerify');
    Route::get('careerOpportunities', 'Api\CareerApiController@job');
    Route::post('apply', 'Api\CareerApiController@jobApplication');
    Route::post('forgotPassword', 'Api\RegistrationController@forgotPassword');
    Route::post('changePassword', 'Api\RegistrationController@changePassword');
//    Route::get('loginToken', 'Api\UserApiController@fetchToken');
});

Route::group(['name' => 'common', 'middleware' => 'auth:sanctum'], function (){
    Route::get('me', 'Api\RegistrationController@me');
    Route::post('userDetails', 'Api\RegistrationController@userDetails');
    Route::post('refreshLogin', 'Api\RegistrationController@refreshLogin');
    Route::get('logout', 'Api\UserApiController@logoutUser');
});

Route::group(['name' => 'dcp', 'middleware' => 'auth:sanctum'], function () {
    Route::get('dcpProfile', 'Api\DcpController@profile');
    Route::post('recordProfileData', 'Api\DcpController@recordProfile');
    Route::get('bookingList', 'Api\DcpController@booking');
    Route::get('timesheetList', 'Api\DcpController@timesheet');
    Route::get('dcpDetails', 'Api\DcpController@details');
    Route::post('recordTimesheet', 'Api\DcpController@recordTimesheet');
    Route::get('fetchAvailability', 'Api\DcpController@getAvailability');
    Route::post('recordAvailability', 'Api\DcpController@setAvailability');
    Route::get('dcpRegProfile', 'Api\DCPProfileApiController@profile');
    Route::post('dcpPasswordUpdate', 'Api\DCPProfileApiController@passwordUpdate');
    Route::post('dcpProfileUpdate', 'Api\DCPProfileApiController@updateProfile');
    Route::post('dcpKinUpdate', 'Api\DCPProfileApiController@updateKin');
    Route::post('additionalExpenses', 'Api\DcpController@additionalExpenses');
});

Route::group(['name' => 'practice', 'middleware' => 'auth:sanctum'], function () {
    Route::get('staffType', 'Api\BookingApiController@staffType');
    Route::post('bookStaff', 'Api\BookingApiController@BookingCreate');
    Route::get('practiceProfile', 'Api\PracticeController@profile');
    Route::post('updatePracticeProfile', 'Api\PracticeController@updateProfile');
    Route::post('changePassword', 'Api\PracticeController@updatePassword');
    Route::get('bookings', 'Api\PracticeController@listBooking');
    Route::post('cancelBookings', 'Api\PracticeController@bookingCancel');
    Route::get('invoiceList', 'Api\PracticeController@invoice');
});
