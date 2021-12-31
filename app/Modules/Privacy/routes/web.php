<?php



Route::group(array('prefix'=>'admin/','module'=>'Privacy','middleware' => ['web','auth', 'can:privacies'], 'namespace' => 'App\Modules\Privacy\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('privacies/','AdminPrivacyController@index')->name('admin.privacies');
    Route::post('privacies/getprivaciesJson','AdminPrivacyController@getprivaciesJson')->name('admin.privacies.getdatajson');
    Route::get('privacies/create','AdminPrivacyController@create')->name('admin.privacies.create');
    Route::post('privacies/store','AdminPrivacyController@store')->name('admin.privacies.store');
    Route::get('privacies/show/{id}','AdminPrivacyController@show')->name('admin.privacies.show');
    Route::get('privacies/edit/{id}','AdminPrivacyController@edit')->name('admin.privacies.edit');
    Route::match(['put', 'patch'], 'privacies/update','AdminPrivacyController@update')->name('admin.privacies.update');
    Route::get('privacies/delete/{id}', 'AdminPrivacyController@destroy')->name('admin.privacies.edit');
});




Route::group(array('module'=>'Privacy','namespace' => 'App\Modules\Privacy\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('privacies/','PrivacyController@index')->name('privacies');

});
