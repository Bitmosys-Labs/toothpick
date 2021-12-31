<?php



Route::group(array('prefix'=>'admin/','module'=>'Term','middleware' => ['web','auth', 'can:terms'], 'namespace' => 'App\Modules\Term\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('terms/','AdminTermController@index')->name('admin.terms');
    Route::post('terms/gettermsJson','AdminTermController@gettermsJson')->name('admin.terms.getdatajson');
    Route::get('terms/create','AdminTermController@create')->name('admin.terms.create');
    Route::post('terms/store','AdminTermController@store')->name('admin.terms.store');
    Route::get('terms/show/{id}','AdminTermController@show')->name('admin.terms.show');
    Route::get('terms/edit/{id}','AdminTermController@edit')->name('admin.terms.edit');
    Route::match(['put', 'patch'], 'terms/update','AdminTermController@update')->name('admin.terms.update');
    Route::get('terms/delete/{id}', 'AdminTermController@destroy')->name('admin.terms.edit');
});




Route::group(array('module'=>'Term','namespace' => 'App\Modules\Term\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('terms/','TermController@index')->name('terms');

});
