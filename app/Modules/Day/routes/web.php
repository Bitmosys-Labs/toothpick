<?php



Route::group(array('prefix'=>'admin/','module'=>'Day','middleware' => ['web','auth', 'can:days'], 'namespace' => 'App\Modules\Day\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('days/','AdminDayController@index')->name('admin.days');
    Route::post('days/getdaysJson','AdminDayController@getdaysJson')->name('admin.days.getdatajson');
    Route::get('days/create','AdminDayController@create')->name('admin.days.create');
    Route::post('days/store','AdminDayController@store')->name('admin.days.store');
    Route::get('days/show/{id}','AdminDayController@show')->name('admin.days.show');
    Route::get('days/edit/{id}','AdminDayController@edit')->name('admin.days.edit');
    Route::match(['put', 'patch'], 'days/update','AdminDayController@update')->name('admin.days.update');
    Route::get('days/delete/{id}', 'AdminDayController@destroy')->name('admin.days.edit');
});




Route::group(array('module'=>'Day','namespace' => 'App\Modules\Day\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('days/','DayController@index')->name('days');

});
