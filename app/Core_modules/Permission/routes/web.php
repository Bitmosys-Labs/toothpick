<?php



Route::group(array('prefix'=>'admin/','module'=>'Permission','middleware' => ['web','auth', 'can:permission'], 'namespace' => 'App\Core_modules\Permission\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('permissions/','AdminPermissionController@index')->name('admin.permissions');
    Route::post('permissions/getpermissionsJson','AdminPermissionController@getpermissionsJson')->name('admin.permissions.getdatajson');
    Route::get('permissions/create','AdminPermissionController@create')->name('admin.permissions.create');
    Route::post('permissions/store','AdminPermissionController@store')->name('admin.permissions.store');
    Route::get('permissions/show/{id}','AdminPermissionController@show')->name('admin.permissions.show');
    Route::get('permissions/edit/{id}','AdminPermissionController@edit')->name('admin.permissions.edit');
    Route::match(['put', 'patch'], 'permissions/update/{id}','AdminPermissionController@update')->name('admin.permissions.update');
    Route::get('permissions/delete/{id}', 'AdminPermissionController@destroy')->name('admin.permissions.edit');
});




Route::group(array('module'=>'Permission','namespace' => 'App\Modules\Permission\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('permissions/','PermissionController@index')->name('permissions');

});
