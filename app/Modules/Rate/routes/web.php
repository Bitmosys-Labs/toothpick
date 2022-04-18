<?php



Route::group(array('prefix'=>'admin/','module'=>'Rate','middleware' => ['web','auth', 'can:rates'], 'namespace' => 'App\Modules\Rate\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('rates/','AdminRateController@index')->name('admin.rates');
    Route::post('rates/getratesJson','AdminRateController@getratesJson')->name('admin.rates.getdatajson');
    Route::get('rates/create','AdminRateController@create')->name('admin.rates.create');
    Route::post('rates/store','AdminRateController@store')->name('admin.rates.store');
    Route::get('rates/show/{id}','AdminRateController@show')->name('admin.rates.show');
    Route::get('rates/edit/{id}','AdminRateController@edit')->name('admin.rates.edit');
    Route::match(['put', 'patch'], 'rates/update','AdminRateController@update')->name('admin.rates.update');
    Route::get('rates/delete/{id}', 'AdminRateController@destroy')->name('admin.rates.edit');
});




Route::group(array('module'=>'Rate','namespace' => 'App\Modules\Rate\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('rates/','RateController@index')->name('rates');

});
