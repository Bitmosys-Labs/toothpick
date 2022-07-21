<?php



Route::group(array('prefix'=>'admin/','module'=>'User_identity','middleware' => ['web','auth', 'can:user_identities'], 'namespace' => 'App\Modules\User_identity\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('user_identities/','AdminUser_identityController@index')->name('admin.user_identities');
    Route::post('user_identities/getuser_identitiesJson','AdminUser_identityController@getuser_identitiesJson')->name('admin.user_identities.getdatajson');
    Route::get('user_identities/create','AdminUser_identityController@create')->name('admin.user_identities.create');
    Route::post('user_identities/store','AdminUser_identityController@store')->name('admin.user_identities.store');
    Route::get('user_identities/show/{id}','AdminUser_identityController@show')->name('admin.user_identities.show');
    Route::get('user_identities/edit/{id}','AdminUser_identityController@edit')->name('admin.user_identities.edit');
    Route::match(['put', 'patch'], 'user_identities/update','AdminUser_identityController@update')->name('admin.user_identities.update');
    Route::get('user_identities/delete/{id}', 'AdminUser_identityController@destroy')->name('admin.user_identities.edit');
});




Route::group(array('module'=>'User_identity','namespace' => 'App\Modules\User_identity\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('user_identities/','User_identityController@index')->name('user_identities');

});
