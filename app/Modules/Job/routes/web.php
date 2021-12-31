<?php



Route::group(array('prefix'=>'admin/','module'=>'Job','middleware' => ['web','auth', 'can:jobs'], 'namespace' => 'App\Modules\Job\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('jobs/','AdminJobController@index')->name('admin.jobs');
    Route::post('jobs/getjobsJson','AdminJobController@getjobsJson')->name('admin.jobs.getdatajson');
    Route::get('jobs/create','AdminJobController@create')->name('admin.jobs.create');
    Route::post('jobs/store','AdminJobController@store')->name('admin.jobs.store');
    Route::get('jobs/show/{id}','AdminJobController@show')->name('admin.jobs.show');
    Route::get('jobs/edit/{id}','AdminJobController@edit')->name('admin.jobs.edit');
    Route::match(['put', 'patch'], 'jobs/update','AdminJobController@update')->name('admin.jobs.update');
    Route::get('jobs/delete/{id}', 'AdminJobController@destroy')->name('admin.jobs.edit');
});




Route::group(array('module'=>'Job','namespace' => 'App\Modules\Job\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('jobs/','JobController@index')->name('jobs');

});
