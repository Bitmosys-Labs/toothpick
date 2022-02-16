<?php



Route::group(array('prefix'=>'admin/','module'=>'Experience','middleware' => ['web','auth', 'can:experiences'], 'namespace' => 'App\Modules\Experience\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('experiences/','AdminExperienceController@index')->name('admin.experiences');
    Route::post('experiences/getexperiencesJson','AdminExperienceController@getexperiencesJson')->name('admin.experiences.getdatajson');
    Route::get('experiences/create','AdminExperienceController@create')->name('admin.experiences.create');
    Route::post('experiences/store','AdminExperienceController@store')->name('admin.experiences.store');
    Route::get('experiences/show/{id}','AdminExperienceController@show')->name('admin.experiences.show');
    Route::get('experiences/edit/{id}','AdminExperienceController@edit')->name('admin.experiences.edit');
    Route::match(['put', 'patch'], 'experiences/update','AdminExperienceController@update')->name('admin.experiences.update');
    Route::get('experiences/delete/{id}', 'AdminExperienceController@destroy')->name('admin.experiences.edit');
});




Route::group(array('module'=>'Experience','namespace' => 'App\Modules\Experience\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('experiences/','ExperienceController@index')->name('experiences');

});
