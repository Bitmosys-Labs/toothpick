<?php



Route::group(array('prefix'=>'admin/','module'=>'Role','middleware' => ['web','auth', 'can:role'], 'namespace' => 'App\Core_modules\Role\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('roles/','AdminRoleController@index')->name('admin.roles');
    Route::post('roles/getrolesJson','AdminRoleController@getrolesJson')->name('admin.roles.getdatajson');
    Route::get('roles/create','AdminRoleController@create')->name('admin.roles.create');
    Route::post('roles/store','AdminRoleController@store')->name('admin.roles.store');
    Route::get('roles/show/{id}','AdminRoleController@show')->name('admin.roles.show');
    Route::get('roles/edit/{id}','AdminRoleController@edit')->name('admin.roles.edit');
    Route::match(['put', 'patch'], 'roles/update/{id}','AdminRoleController@update')->name('admin.roles.update');
    Route::get('roles/delete/{id}', 'AdminRoleController@destroy')->name('admin.roles.edit');
});




Route::group(array('module'=>'Role','namespace' => 'App\Modules\Role\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('roles/','RoleController@index')->name('roles');

});
