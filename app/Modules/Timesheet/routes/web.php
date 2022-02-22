<?php



Route::group(array('prefix'=>'admin/','module'=>'Timesheet','middleware' => ['web','auth', 'can:timesheets'], 'namespace' => 'App\Modules\Timesheet\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('timesheets/','AdminTimesheetController@index')->name('admin.timesheets');
    Route::post('timesheets/gettimesheetsJson','AdminTimesheetController@gettimesheetsJson')->name('admin.timesheets.getdatajson');
    Route::get('timesheets/create','AdminTimesheetController@create')->name('admin.timesheets.create');
    Route::post('timesheets/store','AdminTimesheetController@store')->name('admin.timesheets.store');
    Route::get('timesheets/show/{id}','AdminTimesheetController@show')->name('admin.timesheets.show');
    Route::get('timesheets/edit/{id}','AdminTimesheetController@edit')->name('admin.timesheets.edit');
    Route::match(['put', 'patch'], 'timesheets/update','AdminTimesheetController@update')->name('admin.timesheets.update');
    Route::get('timesheets/delete/{id}', 'AdminTimesheetController@destroy')->name('admin.timesheets.edit');
});




Route::group(array('module'=>'Timesheet','namespace' => 'App\Modules\Timesheet\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('timesheets/','TimesheetController@index')->name('timesheets');

});
