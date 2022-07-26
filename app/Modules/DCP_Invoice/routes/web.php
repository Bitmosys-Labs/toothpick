<?php



Route::group(array('prefix'=>'admin/','module'=>'DCP_Invoice','middleware' => ['web','auth', 'can:dcpInvoices'], 'namespace' => 'App\Modules\DCP_Invoice\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('dcpInvoice/','AdminDCPInvoiceController@index')->name('admin.dcpInvoice');
    Route::post('dcpInvoice/gettimesheetsJson','AdminDCPInvoiceController@gettimesheetsJson')->name('admin.dcpInvoice.getdatajson');
    Route::get('dcpInvoice/create','AdminDCPInvoiceController@create')->name('admin.dcpInvoice.create');
    Route::post('dcpInvoice/store','AdminDCPInvoiceController@store')->name('admin.dcpInvoice.store');
    Route::get('dcpInvoice/show/{id}','AdminDCPInvoiceController@show')->name('admin.dcpInvoice.show');
    Route::get('dcpInvoice/edit/{id}','AdminDCPInvoiceController@edit')->name('admin.dcpInvoice.edit');
    Route::match(['put', 'patch'], 'dcpInvoice/update','AdminDCPInvoiceController@update')->name('admin.dcpInvoice.update');
    Route::get('dcpInvoice/delete/{id}', 'AdminDCPInvoiceController@destroy')->name('admin.dcpInvoice.edit');
    Route::post('payableHours', 'AdminDCPInvoiceController@payableHours')->name('admin.payableHours');
});




Route::group(array('module'=>'DCP_Invoice','namespace' => 'App\Modules\DCP_Invoice\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('DCP_Invoice/','AdminDCPInvoiceController@index')->name('timesheets');

});
