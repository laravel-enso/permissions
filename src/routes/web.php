<?php

Route::group([
    'namespace'  => 'LaravelEnso\PermissionManager\app\Http\Controllers',
    'middleware' => ['web', 'auth', 'core'],
], function () {
    Route::group(['prefix' => 'system', 'as' => 'system.'], function () {
        Route::group(['prefix' => 'permissionGroups', 'as' => 'permissionGroups.'], function () {
            Route::get('initTable', 'PermissionGroupController@initTable')->name('initTable');
            Route::get('getTableData', 'PermissionGroupController@getTableData')->name('getTableData');
        });

        Route::resource('permissionGroups', 'PermissionGroupController');

        Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
            Route::get('initTable', 'PermissionController@initTable')->name('initTable');
            Route::get('getTableData', 'PermissionController@getTableData')->name('getTableData');
        });

        Route::resource('permissions', 'PermissionController');

        Route::group(['prefix' => 'resourcePermissions', 'as' => 'resourcePermissions.'], function () {
            Route::get('create', 'ResourceController@create')->name('create');
            Route::post('store', 'ResourceController@store')->name('store');
        });
    });
});
