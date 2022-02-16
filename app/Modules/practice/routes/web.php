<?php



Route::group(array('prefix'=>'admin/','module'=>'Practice','middleware' => ['web','auth', 'can:practices'], 'namespace' => 'App\Modules\Practice\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('practices/','AdminPracticeController@index')->name('admin.practices');
    Route::post('practices/getpracticesJson','AdminPracticeController@getpracticesJson')->name('admin.practices.getdatajson');
    Route::get('practices/create','AdminPracticeController@create')->name('admin.practices.create');
    Route::post('practices/store','AdminPracticeController@store')->name('admin.practices.store');
    Route::get('practices/show/{id}','AdminPracticeController@show')->name('admin.practices.show');
    Route::get('practices/edit/{id}','AdminPracticeController@edit')->name('admin.practices.edit');
    Route::match(['put', 'patch'], 'practices/update','AdminPracticeController@update')->name('admin.practices.update');
    Route::get('practices/delete/{id}', 'AdminPracticeController@destroy')->name('admin.practices.edit');
});




Route::group(array('module'=>'Practice','namespace' => 'App\Modules\Practice\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('practices/','PracticeController@index')->name('practices');

});
