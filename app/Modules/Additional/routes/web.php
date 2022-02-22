<?php



Route::group(array('prefix'=>'admin/','module'=>'Additional','middleware' => ['web','auth', 'can:additionals'], 'namespace' => 'App\Modules\Additional\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('additionals/','AdminAdditionalController@index')->name('admin.additionals');
    Route::post('additionals/getadditionalsJson','AdminAdditionalController@getadditionalsJson')->name('admin.additionals.getdatajson');
    Route::get('additionals/create','AdminAdditionalController@create')->name('admin.additionals.create');
    Route::post('additionals/store','AdminAdditionalController@store')->name('admin.additionals.store');
    Route::get('additionals/show/{id}','AdminAdditionalController@show')->name('admin.additionals.show');
    Route::get('additionals/edit/{id}','AdminAdditionalController@edit')->name('admin.additionals.edit');
    Route::match(['put', 'patch'], 'additionals/update','AdminAdditionalController@update')->name('admin.additionals.update');
    Route::get('additionals/delete/{id}', 'AdminAdditionalController@destroy')->name('admin.additionals.edit');
});




Route::group(array('module'=>'Additional','namespace' => 'App\Modules\Additional\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('additionals/','AdditionalController@index')->name('additionals');

});
