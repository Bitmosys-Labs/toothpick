<?php



Route::group(array('prefix'=>'admin/','module'=>'User_immunization','middleware' => ['web','auth', 'can:user_immunizations'], 'namespace' => 'App\Modules\User_immunization\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('user_immunizations/','AdminUser_immunizationController@index')->name('admin.user_immunizations');
    Route::post('user_immunizations/getuser_immunizationsJson','AdminUser_immunizationController@getuser_immunizationsJson')->name('admin.user_immunizations.getdatajson');
    Route::get('user_immunizations/create','AdminUser_immunizationController@create')->name('admin.user_immunizations.create');
    Route::post('user_immunizations/store','AdminUser_immunizationController@store')->name('admin.user_immunizations.store');
    Route::get('user_immunizations/show/{id}','AdminUser_immunizationController@show')->name('admin.user_immunizations.show');
    Route::get('user_immunizations/edit/{id}','AdminUser_immunizationController@edit')->name('admin.user_immunizations.edit');
    Route::match(['put', 'patch'], 'user_immunizations/update','AdminUser_immunizationController@update')->name('admin.user_immunizations.update');
    Route::get('user_immunizations/delete/{id}', 'AdminUser_immunizationController@destroy')->name('admin.user_immunizations.edit');
});




Route::group(array('module'=>'User_immunization','namespace' => 'App\Modules\User_immunization\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('user_immunizations/','User_immunizationController@index')->name('user_immunizations');

});
