<?php

Route::group(['prefix'=>'permissions', 'middleware' => ['auth', 'admin']], function () { 
    Route::get('/', 'PermissionController@index');
    Route::get('rules', 'PermissionController@index');
    Route::get('groups', 'GroupController@index');
    Route::get('groups/create', 'GroupController@create');
    Route::get('groups/edit/{group_id}', 'GroupController@edit');
    Route::post('groups/store', 'GroupController@store');
    Route::post('groups/update/{group_id}', 'GroupController@update');

    Route::group(['prefix'=>'user-assign'], function () { 
        Route::get('users', 'UserGroupController@index');
        Route::get('assign/{user_id}', 'UserGroupController@assign');
        Route::post('assign/{user_id}', 'UserGroupController@assign_store');
    });
});