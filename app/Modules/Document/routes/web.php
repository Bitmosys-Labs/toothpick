<?php



Route::group(array('prefix'=>'admin/','module'=>'Document','middleware' => ['web','auth', 'can:documents'], 'namespace' => 'App\Modules\Document\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('documents/','AdminDocumentController@index')->name('admin.documents');
    Route::post('documents/getdocumentsJson','AdminDocumentController@getdocumentsJson')->name('admin.documents.getdatajson');
    Route::get('documents/create','AdminDocumentController@create')->name('admin.documents.create');
    Route::post('documents/store','AdminDocumentController@store')->name('admin.documents.store');
    Route::get('documents/show/{id}','AdminDocumentController@show')->name('admin.documents.show');
    Route::get('documents/edit/{id}','AdminDocumentController@edit')->name('admin.documents.edit');
    Route::match(['put', 'patch'], 'documents/update','AdminDocumentController@update')->name('admin.documents.update');
    Route::get('documents/delete/{id}', 'AdminDocumentController@destroy')->name('admin.documents.edit');
});




Route::group(array('module'=>'Document','namespace' => 'App\Modules\Document\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('documents/','DocumentController@index')->name('documents');

});
