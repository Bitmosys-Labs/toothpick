<?php



Route::group(array('prefix'=>'admin/','module'=>'Dcp','middleware' => ['web','auth', 'can:dcps'], 'namespace' => 'App\Modules\Dcp\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('dcps/','AdminDcpController@index')->name('admin.dcps');
    Route::post('dcps/getdcpsJson','AdminDcpController@getdcpsJson')->name('admin.dcps.getdatajson');
    Route::get('dcps/create','AdminDcpController@create')->name('admin.dcps.create');
    Route::post('dcps/store','AdminDcpController@store')->name('admin.dcps.store');
    Route::post('dcps/availability','AdminDcpController@availability')->name('admin.dcps.availability');
    Route::get('dcps/show/{id}','AdminDcpController@show')->name('admin.dcps.show');
    Route::get('dcps/edit/{id}','AdminDcpController@edit')->name('admin.dcps.edit');
    Route::match(['put', 'patch'], 'dcps/update','AdminDcpController@update')->name('admin.dcps.update');
    Route::get('dcps/delete/{id}', 'AdminDcpController@destroy')->name('admin.dcps.edit');
    Route::get('dcps/list/{id}', 'AdminDcpController@listBookings')->name('admin.dcps.list');
    Route::get('dcpEmployemntHistory', 'AdminDcpController@history')->name('admin.dcps.employmentHistory');
});




Route::group(array('module'=>'Dcp','namespace' => 'App\Modules\Dcp\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('dcps/','DcpController@index')->name('dcps');

});
