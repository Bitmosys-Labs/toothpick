<?php



Route::group(array('prefix'=>'admin/','module'=>'Team','middleware' => ['web','auth', 'can:teams'], 'namespace' => 'App\Modules\Team\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('teams/','AdminTeamController@index')->name('admin.teams');
    Route::post('teams/getteamsJson','AdminTeamController@getteamsJson')->name('admin.teams.getdatajson');
    Route::get('teams/create','AdminTeamController@create')->name('admin.teams.create');
    Route::post('teams/store','AdminTeamController@store')->name('admin.teams.store');
    Route::get('teams/show/{id}','AdminTeamController@show')->name('admin.teams.show');
    Route::get('teams/edit/{id}','AdminTeamController@edit')->name('admin.teams.edit');
    Route::match(['put', 'patch'], 'teams/update','AdminTeamController@update')->name('admin.teams.update');
    Route::get('teams/delete/{id}', 'AdminTeamController@destroy')->name('admin.teams.edit');
});




Route::group(array('module'=>'Team','namespace' => 'App\Modules\Team\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('teams/','TeamController@index')->name('teams');

});
