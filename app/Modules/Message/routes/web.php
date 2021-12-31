<?php



Route::group(array('prefix'=>'admin/','module'=>'Message','middleware' => ['web','auth', 'can:messages'], 'namespace' => 'App\Modules\Message\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('messages/','AdminMessageController@index')->name('admin.messages');
    Route::post('messages/getmessagesJson','AdminMessageController@getmessagesJson')->name('admin.messages.getdatajson');
    Route::get('messages/create','AdminMessageController@create')->name('admin.messages.create');
    Route::post('messages/store','AdminMessageController@store')->name('admin.messages.store');
    Route::get('messages/show/{id}','AdminMessageController@show')->name('admin.messages.show');
    Route::get('messages/edit/{id}','AdminMessageController@edit')->name('admin.messages.edit');
    Route::match(['put', 'patch'], 'messages/update','AdminMessageController@update')->name('admin.messages.update');
    Route::get('messages/delete/{id}', 'AdminMessageController@destroy')->name('admin.messages.edit');
    Route::get('messages/toggle/{id}', 'AdminMessageController@toggle')->name('admin.messages.toggle');
    Route::post('messages/reply/{id}', 'AdminMessageController@reply')->name('admin.messages.reply');
});




Route::group(array('module'=>'Message','namespace' => 'App\Modules\Message\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('messages/','MessageController@index')->name('messages');

});
