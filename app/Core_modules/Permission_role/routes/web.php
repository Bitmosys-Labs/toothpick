<?php



Route::group(array('prefix'=>'admin/','module'=>'Permission_role','middleware' => ['web','auth', 'can:permission'], 'namespace' => 'App\Core_modules\Permission_role\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('permission_roles/','AdminPermission_roleController@index')->name('admin.permission_roles');
    Route::post('permission_roles/getpermission_rolesJson','AdminPermission_roleController@getpermission_rolesJson')->name('admin.permission_roles.getdatajson');
    Route::get('permission_roles/create','AdminPermission_roleController@create')->name('admin.permission_roles.create');
    Route::post('permission_roles/store','AdminPermission_roleController@store')->name('admin.permission_roles.store');
    Route::get('permission_roles/show/{id}','AdminPermission_roleController@show')->name('admin.permission_roles.show');
    Route::get('permission_roles/edit/{id}','AdminPermission_roleController@edit')->name('admin.permission_roles.edit');
    Route::get('permission_roles/assign-permissions/{id}','AdminPermission_roleController@assignPermissions')->name('admin.assign_permission.edit');
    Route::post('permission_roles/assign-permissions/','AdminPermission_roleController@assignPermissionsUpdate')->name('admin.assign_permission.update');
    Route::match(['put', 'patch'], 'permission_roles/update/{id}','AdminPermission_roleController@update')->name('admin.permission_roles.update');
    Route::get('permission_roles/delete/{id}', 'AdminPermission_roleController@destroy')->name('admin.permission_roles.delete');
    Route::get('permission_roles_json','AdminPermission_roleController@permisson_roles')->name('admin.permission_roles.json');
});




Route::group(array('module'=>'Permission_role','namespace' => 'App\Core_modules\Permission_role\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('permission_roles/','Permission_roleController@index')->name('permission_roles');

});
