<?php



Route::group(array('prefix'=>'admin/','module'=>'Identity','middleware' => ['web','auth', 'can:identities'], 'namespace' => 'App\Modules\Identity\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('identities/','AdminIdentityController@index')->name('admin.identities');
    Route::post('identities/getidentitiesJson','AdminIdentityController@getidentitiesJson')->name('admin.identities.getdatajson');
    Route::get('identities/create','AdminIdentityController@create')->name('admin.identities.create');
    Route::post('identities/store','AdminIdentityController@store')->name('admin.identities.store');
    Route::get('identities/show/{id}','AdminIdentityController@show')->name('admin.identities.show');
    Route::get('identities/edit/{id}','AdminIdentityController@edit')->name('admin.identities.edit');
    Route::match(['put', 'patch'], 'identities/update','AdminIdentityController@update')->name('admin.identities.update');
    Route::get('identities/delete/{id}', 'AdminIdentityController@destroy')->name('admin.identities.edit');
});




Route::group(array('module'=>'Identity','namespace' => 'App\Modules\Identity\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('identities/','IdentityController@index')->name('identities');

});
