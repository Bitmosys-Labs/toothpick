{PHP_TAG}



Route::group(array('prefix'=>'admin/','module'=>'{UCFIRST_MODULE_NAME}','middleware' => ['web','auth', 'can:{MODULE}'], 'namespace' => 'App\Modules\{UCFIRST_MODULE_NAME}\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('{MODULE}/','{ADMIN_MODULE_CONTROLLER}@index')->name('admin.{MODULE}');
    Route::post('{MODULE}/get{MODULE}Json','{ADMIN_MODULE_CONTROLLER}@get{MODULE}Json')->name('admin.{MODULE}.getdatajson');
    Route::get('{MODULE}/create','{ADMIN_MODULE_CONTROLLER}@create')->name('admin.{MODULE}.create');
    Route::post('{MODULE}/store','{ADMIN_MODULE_CONTROLLER}@store')->name('admin.{MODULE}.store');
    Route::get('{MODULE}/show/{id}','{ADMIN_MODULE_CONTROLLER}@show')->name('admin.{MODULE}.show');
    Route::get('{MODULE}/edit/{id}','{ADMIN_MODULE_CONTROLLER}@edit')->name('admin.{MODULE}.edit');
    Route::match(['put', 'patch'], '{MODULE}/update','{ADMIN_MODULE_CONTROLLER}@update')->name('admin.{MODULE}.update');
    Route::get('{MODULE}/delete/{id}', '{ADMIN_MODULE_CONTROLLER}@destroy')->name('admin.{MODULE}.edit');
});




Route::group(array('module'=>'{UCFIRST_MODULE_NAME}','namespace' => 'App\Modules\{UCFIRST_MODULE_NAME}\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('{MODULE}/','{PUBLIC_MODULE_CONTROLLER}@index')->name('{MODULE}');

});
