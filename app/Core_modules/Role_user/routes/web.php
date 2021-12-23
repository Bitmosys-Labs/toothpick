<?php



Route::group(array('prefix'=>'admin/','module'=>'Role_user','middleware' => ['web','auth', 'can:role'], 'namespace' => 'App\Core_modules\Role_user\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('role_users/','AdminRole_userController@index')->name('admin.role_users');
    Route::post('role_users/getrole_usersJson','AdminRole_userController@getrole_usersJson')->name('admin.role_users.getdatajson');
    Route::get('role_users/create','AdminRole_userController@create')->name('admin.role_users.create');
    Route::post('role_users/store','AdminRole_userController@store')->name('admin.role_users.store');
    Route::get('role_users/show/{id}','AdminRole_userController@show')->name('admin.role_users.show');
    Route::get('role_users/edit/{id}','AdminRole_userController@edit')->name('admin.role_users.edit');
    Route::match(['put', 'patch'], 'role_users/update/{id}','AdminRole_userController@update')->name('admin.role_users.update');
    Route::get('role_users/delete/{id}', 'AdminRole_userController@destroy')->name('admin.role_users.edit');
});




Route::group(array('module'=>'Role_user','namespace' => 'App\Core_modules\Role_user\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('role_users/','Role_userController@index')->name('role_users');

});
