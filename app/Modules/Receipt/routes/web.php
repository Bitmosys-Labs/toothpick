<?php



Route::group(array('prefix'=>'admin/','module'=>'Receipt','middleware' => ['web','auth', 'can:receipts'], 'namespace' => 'App\Modules\Receipt\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('receipts/','AdminReceiptController@index')->name('admin.receipts');
    Route::post('receipts/getreceiptsJson','AdminReceiptController@getreceiptsJson')->name('admin.receipts.getdatajson');
    Route::get('receipts/create','AdminReceiptController@create')->name('admin.receipts.create');
    Route::post('receipts/store','AdminReceiptController@store')->name('admin.receipts.store');
    Route::get('receipts/show/{id}','AdminReceiptController@show')->name('admin.receipts.show');
    Route::get('receipts/edit/{id}','AdminReceiptController@edit')->name('admin.receipts.edit');
    Route::match(['put', 'patch'], 'receipts/update','AdminReceiptController@update')->name('admin.receipts.update');
    Route::get('receipts/delete/{id}', 'AdminReceiptController@destroy')->name('admin.receipts.edit');
});




Route::group(array('module'=>'Receipt','namespace' => 'App\Modules\Receipt\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('receipts/','ReceiptController@index')->name('receipts');

});
