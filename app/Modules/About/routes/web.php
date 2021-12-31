<?php



Route::group(array('prefix'=>'admin/','module'=>'About','middleware' => ['web','auth', 'can:abouts'], 'namespace' => 'App\Modules\About\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('abouts/','AdminAboutController@index')->name('admin.abouts');
    Route::post('abouts/getaboutsJson','AdminAboutController@getaboutsJson')->name('admin.abouts.getdatajson');
    Route::get('abouts/create','AdminAboutController@create')->name('admin.abouts.create');
    Route::post('abouts/store','AdminAboutController@store')->name('admin.abouts.store');
    Route::get('abouts/show/{id}','AdminAboutController@show')->name('admin.abouts.show');
    Route::get('abouts/edit/{id}','AdminAboutController@edit')->name('admin.abouts.edit');
    Route::match(['put', 'patch'], 'abouts/update','AdminAboutController@update')->name('admin.abouts.update');
    Route::get('abouts/delete/{id}', 'AdminAboutController@destroy')->name('admin.abouts.edit');
});




Route::group(array('module'=>'About','namespace' => 'App\Modules\About\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('abouts/','AboutController@index')->name('abouts');

});
