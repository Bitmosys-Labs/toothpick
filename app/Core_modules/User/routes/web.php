<?php



Route::group(array('prefix'=>'admin/','module'=>'User','middleware' => ['web','auth','can:control_panel'], 'namespace' => 'App\Core_modules\User\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('users/','AdminUserController@index')->name('admin.users');
    Route::post('users/getusersJson','AdminUserController@getusersJson')->name('admin.users.getdatajson');
    Route::get('users/create','AdminUserController@create')->name('admin.users.create');
    Route::post('users/store','AdminUserController@store')->name('admin.users.store');
    Route::get('users/show/{id}','AdminUserController@show')->name('admin.users.show');
    Route::get('users/edit/{id}','AdminUserController@edit')->name('admin.users.edit');
    Route::match(['put', 'patch'], 'users/update/{id}','AdminUserController@update')->name('admin.users.update');
    Route::get('users/delete/{id}', 'AdminUserController@destroy')->name('admin.users.edit');
});




Route::group(array('module'=>'User','namespace' => 'App\Core_modules\User\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('users/','UserController@index')->name('users');

});
