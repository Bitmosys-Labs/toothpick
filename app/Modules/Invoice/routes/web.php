<?php



Route::group(array('prefix'=>'admin/','module'=>'Invoice','middleware' => ['web','auth', 'can:invoices'], 'namespace' => 'App\Modules\Invoice\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('invoices/','AdminInvoiceController@index')->name('admin.invoices');
    Route::post('invoices/getinvoicesJson','AdminInvoiceController@getinvoicesJson')->name('admin.invoices.getdatajson');
    Route::get('invoices/create','AdminInvoiceController@create')->name('admin.invoices.create');
    Route::post('invoices/store','AdminInvoiceController@store')->name('admin.invoices.store');
    Route::get('invoices/show/{id}','AdminInvoiceController@show')->name('admin.invoices.show');
    Route::get('invoices/edit/{id}','AdminInvoiceController@edit')->name('admin.invoices.edit');
    Route::match(['put', 'patch'], 'invoices/update','AdminInvoiceController@update')->name('admin.invoices.update');
    Route::get('invoices/delete/{id}', 'AdminInvoiceController@destroy')->name('admin.invoices.edit');
});




Route::group(array('module'=>'Invoice','namespace' => 'App\Modules\Invoice\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('invoices/','InvoiceController@index')->name('invoices');

});
