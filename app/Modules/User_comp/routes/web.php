<?php



Route::group(array('prefix'=>'admin/','module'=>'User_comp','middleware' => ['web','auth', 'can:user_comps'], 'namespace' => 'App\Modules\User_comp\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('user_comps/','AdminUser_compController@index')->name('admin.user_comps');
    Route::post('user_comps/getuser_compsJson','AdminUser_compController@getuser_compsJson')->name('admin.user_comps.getdatajson');
    Route::get('user_comps/create','AdminUser_compController@create')->name('admin.user_comps.create');
    Route::post('user_comps/store','AdminUser_compController@store')->name('admin.user_comps.store');
    Route::get('user_comps/show/{id}','AdminUser_compController@show')->name('admin.user_comps.show');
    Route::get('user_comps/edit/{id}','AdminUser_compController@edit')->name('admin.user_comps.edit');
    Route::match(['put', 'patch'], 'user_comps/update','AdminUser_compController@update')->name('admin.user_comps.update');
    Route::get('user_comps/delete/{id}', 'AdminUser_compController@destroy')->name('admin.user_comps.edit');
    Route::get('user_comps/get/dcp', 'AdminUser_compController@getDcp')->name('admin.user_comps.get.dcp');

});




Route::group(array('module'=>'User_comp','namespace' => 'App\Modules\User_comp\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('user_comps/','User_compController@index')->name('user_comps');

});
