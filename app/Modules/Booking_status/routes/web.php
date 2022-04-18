<?php



Route::group(array('prefix'=>'admin/','module'=>'Booking_status','middleware' => ['web','auth', 'can:booking_statuses'], 'namespace' => 'App\Modules\Booking_status\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('booking_statuses/','AdminBooking_statusController@index')->name('admin.booking_statuses');
    Route::post('booking_statuses/getbooking_statusesJson','AdminBooking_statusController@getbooking_statusesJson')->name('admin.booking_statuses.getdatajson');
    Route::get('booking_statuses/create','AdminBooking_statusController@create')->name('admin.booking_statuses.create');
    Route::post('booking_statuses/store','AdminBooking_statusController@store')->name('admin.booking_statuses.store');
    Route::get('booking_statuses/show/{id}','AdminBooking_statusController@show')->name('admin.booking_statuses.show');
    Route::get('booking_statuses/edit/{id}','AdminBooking_statusController@edit')->name('admin.booking_statuses.edit');
    Route::match(['put', 'patch'], 'booking_statuses/update','AdminBooking_statusController@update')->name('admin.booking_statuses.update');
    Route::get('booking_statuses/delete/{id}', 'AdminBooking_statusController@destroy')->name('admin.booking_statuses.edit');
});




Route::group(array('module'=>'Booking_status','namespace' => 'App\Modules\Booking_status\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('booking_statuses/','Booking_statusController@index')->name('booking_statuses');

});
