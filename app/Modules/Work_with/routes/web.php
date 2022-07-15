<?php



Route::group(array('prefix'=>'admin/','module'=>'Work_with','middleware' => ['web','auth', 'can:work_withs'], 'namespace' => 'App\Modules\Work_with\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('work_withs/','AdminWork_withController@index')->name('admin.work_withs');
    Route::post('work_withs/getwork_withsJson','AdminWork_withController@getwork_withsJson')->name('admin.work_withs.getdatajson');
    Route::get('work_withs/create','AdminWork_withController@create')->name('admin.work_withs.create');
    Route::post('work_withs/store','AdminWork_withController@store')->name('admin.work_withs.store');
    Route::get('work_withs/show/{id}','AdminWork_withController@show')->name('admin.work_withs.show');
    Route::get('work_withs/edit/{id}','AdminWork_withController@edit')->name('admin.work_withs.edit');
    Route::match(['put', 'patch'], 'work_withs/update','AdminWork_withController@update')->name('admin.work_withs.update');
    Route::get('work_withs/delete/{id}', 'AdminWork_withController@destroy')->name('admin.work_withs.edit');
});




Route::group(array('module'=>'Work_with','namespace' => 'App\Modules\Work_with\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('work_withs/','Work_withController@index')->name('work_withs');

});
