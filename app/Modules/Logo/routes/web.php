<?php



Route::group(array('prefix'=>'admin/','module'=>'Logo','middleware' => ['web','auth', 'can:logos'], 'namespace' => 'App\Modules\Logo\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('logos/','AdminLogoController@index')->name('admin.logos');
    Route::post('logos/getlogosJson','AdminLogoController@getlogosJson')->name('admin.logos.getdatajson');
    Route::get('logos/create','AdminLogoController@create')->name('admin.logos.create');
    Route::post('logos/store','AdminLogoController@store')->name('admin.logos.store');
    Route::get('logos/show/{id}','AdminLogoController@show')->name('admin.logos.show');
    Route::get('logos/edit/{id}','AdminLogoController@edit')->name('admin.logos.edit');
    Route::match(['put', 'patch'], 'logos/update','AdminLogoController@update')->name('admin.logos.update');
    Route::get('logos/delete/{id}', 'AdminLogoController@destroy')->name('admin.logos.edit');
});




Route::group(array('module'=>'Logo','namespace' => 'App\Modules\Logo\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('logos/','LogoController@index')->name('logos');

});
