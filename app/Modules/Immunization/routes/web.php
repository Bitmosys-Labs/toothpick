<?php



Route::group(array('prefix'=>'admin/','module'=>'Immunization','middleware' => ['web','auth', 'can:immunizations'], 'namespace' => 'App\Modules\Immunization\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('immunizations/','AdminImmunizationController@index')->name('admin.immunizations');
    Route::post('immunizations/getimmunizationsJson','AdminImmunizationController@getimmunizationsJson')->name('admin.immunizations.getdatajson');
    Route::get('immunizations/create','AdminImmunizationController@create')->name('admin.immunizations.create');
    Route::post('immunizations/store','AdminImmunizationController@store')->name('admin.immunizations.store');
    Route::get('immunizations/show/{id}','AdminImmunizationController@show')->name('admin.immunizations.show');
    Route::get('immunizations/edit/{id}','AdminImmunizationController@edit')->name('admin.immunizations.edit');
    Route::match(['put', 'patch'], 'immunizations/update','AdminImmunizationController@update')->name('admin.immunizations.update');
    Route::get('immunizations/delete/{id}', 'AdminImmunizationController@destroy')->name('admin.immunizations.edit');
});




Route::group(array('module'=>'Immunization','namespace' => 'App\Modules\Immunization\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('immunizations/','ImmunizationController@index')->name('immunizations');

});
