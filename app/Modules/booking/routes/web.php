<?php



Route::group(array('prefix'=>'admin/','module'=>'Booking','middleware' => ['web','auth', 'can:bookings'], 'namespace' => 'App\Modules\Booking\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('bookings/','AdminBookingController@index')->name('admin.bookings');
    Route::post('bookings/getbookingsJson','AdminBookingController@getbookingsJson')->name('admin.bookings.getdatajson');
    Route::get('bookings/create','AdminBookingController@create')->name('admin.bookings.create');
    Route::post('bookings/store','AdminBookingController@store')->name('admin.bookings.store');
    Route::get('bookings/show/{id}','AdminBookingController@show')->name('admin.bookings.show');
    Route::get('bookings/edit/{id}','AdminBookingController@edit')->name('admin.bookings.edit');
    Route::match(['put', 'patch'], 'bookings/update','AdminBookingController@update')->name('admin.bookings.update');
    Route::get('bookings/delete/{id}', 'AdminBookingController@destroy')->name('admin.bookings.edit');
});




Route::group(array('module'=>'Booking','namespace' => 'App\Modules\Booking\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('bookings/','BookingController@index')->name('bookings');

});
