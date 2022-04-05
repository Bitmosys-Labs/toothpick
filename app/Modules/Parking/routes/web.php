<?php



Route::group(array('prefix'=>'admin/','module'=>'Parking','middleware' => ['web','auth', 'can:parkings'], 'namespace' => 'App\Modules\Parking\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('parkings/','AdminParkingController@index')->name('admin.parkings');
    Route::post('parkings/getparkingsJson','AdminParkingController@getparkingsJson')->name('admin.parkings.getdatajson');
    Route::get('parkings/create','AdminParkingController@create')->name('admin.parkings.create');
    Route::post('parkings/store','AdminParkingController@store')->name('admin.parkings.store');
    Route::get('parkings/show/{id}','AdminParkingController@show')->name('admin.parkings.show');
    Route::get('parkings/edit/{id}','AdminParkingController@edit')->name('admin.parkings.edit');
    Route::match(['put', 'patch'], 'parkings/update','AdminParkingController@update')->name('admin.parkings.update');
    Route::get('parkings/delete/{id}', 'AdminParkingController@destroy')->name('admin.parkings.edit');
});




Route::group(array('module'=>'Parking','namespace' => 'App\Modules\Parking\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('parkings/','ParkingController@index')->name('parkings');

});
