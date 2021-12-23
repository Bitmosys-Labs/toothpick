<?php
Route::group(array('module'=>'Developer_tool','middleware' => ['web','auth', 'can:control_panel'], 'namespace' => 'App\Core_modules\Developer_tool\Controllers'), function() {
    //Your routes belong to this module.
    Route::get('admin/tools','ToolController@index');
    Route::post('admin/tools/generate','ToolController@generate')->name('tool.generate');
});
