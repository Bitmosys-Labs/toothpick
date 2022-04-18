<?php



Route::group(array('prefix'=>'admin/','module'=>'Bank_detail','middleware' => ['web','auth', 'can:bank_details'], 'namespace' => 'App\Modules\Bank_detail\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('bank_details/','AdminBank_detailController@index')->name('admin.bank_details');
    Route::post('bank_details/getbank_detailsJson','AdminBank_detailController@getbank_detailsJson')->name('admin.bank_details.getdatajson');
    Route::get('bank_details/create','AdminBank_detailController@create')->name('admin.bank_details.create');
    Route::post('bank_details/store','AdminBank_detailController@store')->name('admin.bank_details.store');
    Route::get('bank_details/show/{id}','AdminBank_detailController@show')->name('admin.bank_details.show');
    Route::get('bank_details/edit/{id}','AdminBank_detailController@edit')->name('admin.bank_details.edit');
    Route::match(['put', 'patch'], 'bank_details/update','AdminBank_detailController@update')->name('admin.bank_details.update');
    Route::get('bank_details/delete/{id}', 'AdminBank_detailController@destroy')->name('admin.bank_details.edit');
});




Route::group(array('module'=>'Bank_detail','namespace' => 'App\Modules\Bank_detail\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('bank_details/','Bank_detailController@index')->name('bank_details');

});
