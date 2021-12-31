<?php



Route::group(array('prefix'=>'admin/','module'=>'Job_application','middleware' => ['web','auth', 'can:job_applications'], 'namespace' => 'App\Modules\Job_application\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('job_applications/','AdminJob_applicationController@index')->name('admin.job_applications');
    Route::post('job_applications/getjob_applicationsJson','AdminJob_applicationController@getjob_applicationsJson')->name('admin.job_applications.getdatajson');
    Route::get('job_applications/create','AdminJob_applicationController@create')->name('admin.job_applications.create');
    Route::post('job_applications/store','AdminJob_applicationController@store')->name('admin.job_applications.store');
    Route::get('job_applications/show/{id}','AdminJob_applicationController@show')->name('admin.job_applications.show');
    Route::get('job_applications/edit/{id}','AdminJob_applicationController@edit')->name('admin.job_applications.edit');
    Route::match(['put', 'patch'], 'job_applications/update','AdminJob_applicationController@update')->name('admin.job_applications.update');
    Route::get('job_applications/delete/{id}', 'AdminJob_applicationController@destroy')->name('admin.job_applications.edit');
});




Route::group(array('module'=>'Job_application','namespace' => 'App\Modules\Job_application\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('job_applications/','Job_applicationController@index')->name('job_applications');

});
