<?php

Route::get('post', 'PostController@index');
Route::post('post', 'PostController@create');

Route::group(['middleware' => 'auth.very_basic'], function() {
    
    Route::get('post/admin_list', 'PostController@adminList');
    Route::post('post/admin_list', 'PostController@delete');
    
    Route::get('post/admin_edit', 'PostController@edit');
    Route::post('post/admin_edit', 'PostController@update');

    Route::get('/post/admin_update', function(){
        return view('post/admin_update');
    });
    
    Route::get('/post/admin_delete', function(){
        return view('post/admin_delete');
    });
});


// Route::post('post/admin_list', function(){
//     dump(request()->all());
// });


// Route::post('post/admin_edit', function(){
//     dump(request()->all());
// });
