<?php



Route::group(array('prefix'=>'admin/','module'=>'Availability','middleware' => ['web','auth', 'can:availabilities'], 'namespace' => 'App\Modules\Availability\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('availabilities/','AdminAvailabilityController@index')->name('admin.availabilities');
    Route::post('availabilities/getavailabilitiesJson','AdminAvailabilityController@getavailabilitiesJson')->name('admin.availabilities.getdatajson');
    Route::get('availabilities/create','AdminAvailabilityController@create')->name('admin.availabilities.create');
    Route::post('availabilities/store','AdminAvailabilityController@store')->name('admin.availabilities.store');
    Route::get('availabilities/show/{id}','AdminAvailabilityController@show')->name('admin.availabilities.show');
    Route::get('availabilities/edit/{id}','AdminAvailabilityController@edit')->name('admin.availabilities.edit');
    Route::match(['put', 'patch'], 'availabilities/update','AdminAvailabilityController@update')->name('admin.availabilities.update');
    Route::get('availabilities/delete/{id}', 'AdminAvailabilityController@destroy')->name('admin.availabilities.edit');
});




Route::group(array('module'=>'Availability','namespace' => 'App\Modules\Availability\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('availabilities/','AvailabilityController@index')->name('availabilities');

});
