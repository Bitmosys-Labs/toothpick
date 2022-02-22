<?php



Route::group(array('prefix'=>'admin/','module'=>'Staff','middleware' => ['web','auth', 'can:staff'], 'namespace' => 'App\Modules\Staff\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('staff/','AdminStaffController@index')->name('admin.staff');
    Route::post('staff/getstaffJson','AdminStaffController@getstaffJson')->name('admin.staff.getdatajson');
    Route::get('staff/create','AdminStaffController@create')->name('admin.staff.create');
    Route::post('staff/store','AdminStaffController@store')->name('admin.staff.store');
    Route::get('staff/show/{id}','AdminStaffController@show')->name('admin.staff.show');
    Route::get('staff/edit/{id}','AdminStaffController@edit')->name('admin.staff.edit');
    Route::match(['put', 'patch'], 'staff/update','AdminStaffController@update')->name('admin.staff.update');
    Route::get('staff/delete/{id}', 'AdminStaffController@destroy')->name('admin.staff.edit');
});




Route::group(array('module'=>'Staff','namespace' => 'App\Modules\Staff\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('staff/','StaffController@index')->name('staff');

});
