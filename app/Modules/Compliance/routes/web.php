<?php



Route::group(array('prefix'=>'admin/','module'=>'Compliance','middleware' => ['web','auth', 'can:compliances'], 'namespace' => 'App\Modules\Compliance\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('compliances/','AdminComplianceController@index')->name('admin.compliances');
    Route::post('compliances/getcompliancesJson','AdminComplianceController@getcompliancesJson')->name('admin.compliances.getdatajson');
    Route::get('compliances/create','AdminComplianceController@create')->name('admin.compliances.create');
    Route::post('compliances/store','AdminComplianceController@store')->name('admin.compliances.store');
    Route::get('compliances/show/{id}','AdminComplianceController@show')->name('admin.compliances.show');
    Route::get('compliances/edit/{id}','AdminComplianceController@edit')->name('admin.compliances.edit');
    Route::match(['put', 'patch'], 'compliances/update','AdminComplianceController@update')->name('admin.compliances.update');
    Route::get('compliances/delete/{id}', 'AdminComplianceController@destroy')->name('admin.compliances.edit');
});




Route::group(array('module'=>'Compliance','namespace' => 'App\Modules\Compliance\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('compliances/','ComplianceController@index')->name('compliances');

});
