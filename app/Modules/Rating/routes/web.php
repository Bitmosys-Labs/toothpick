<?php



Route::group(array('prefix'=>'admin/','module'=>'Rating','middleware' => ['web','auth', 'can:ratings'], 'namespace' => 'App\Modules\Rating\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('ratings/','AdminRatingController@index')->name('admin.ratings');
    Route::post('ratings/getratingsJson','AdminRatingController@getratingsJson')->name('admin.ratings.getdatajson');
    Route::get('ratings/create','AdminRatingController@create')->name('admin.ratings.create');
    Route::post('ratings/store','AdminRatingController@store')->name('admin.ratings.store');
    Route::get('ratings/show/{id}','AdminRatingController@show')->name('admin.ratings.show');
    Route::get('ratings/edit/{id}','AdminRatingController@edit')->name('admin.ratings.edit');
    Route::match(['put', 'patch'], 'ratings/update','AdminRatingController@update')->name('admin.ratings.update');
    Route::get('ratings/delete/{id}', 'AdminRatingController@destroy')->name('admin.ratings.edit');
});




Route::group(array('module'=>'Rating','namespace' => 'App\Modules\Rating\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('ratings/','RatingController@index')->name('ratings');

});
