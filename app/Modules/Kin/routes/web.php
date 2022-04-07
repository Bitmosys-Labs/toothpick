<?php



Route::group(array('prefix'=>'admin/','module'=>'Kin','middleware' => ['web','auth', 'can:kin'], 'namespace' => 'App\Modules\Kin\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('kin/','AdminKinController@index')->name('admin.kin');
    Route::post('kin/getkinJson','AdminKinController@getkinJson')->name('admin.kin.getdatajson');
    Route::get('kin/create','AdminKinController@create')->name('admin.kin.create');
    Route::post('kin/store','AdminKinController@store')->name('admin.kin.store');
    Route::get('kin/show/{id}','AdminKinController@show')->name('admin.kin.show');
    Route::get('kin/edit/{id}','AdminKinController@edit')->name('admin.kin.edit');
    Route::match(['put', 'patch'], 'kin/update','AdminKinController@update')->name('admin.kin.update');
    Route::get('kin/delete/{id}', 'AdminKinController@destroy')->name('admin.kin.edit');
});




Route::group(array('module'=>'Kin','namespace' => 'App\Modules\Kin\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('kin/','KinController@index')->name('kin');

});
