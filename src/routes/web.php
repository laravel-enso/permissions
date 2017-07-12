<?php

Route::middleware(['web', 'auth', 'core'])
    ->namespace('LaravelEnso\PermissionManager\app\Http\Controllers')
    ->group(function () {
        Route::prefix('system')->as('system.')
            ->group(function () {
                Route::prefix('permissionGroups')->as('permissionGroups.')
                    ->group(function () {
                        Route::get('initTable', 'PermissionGroupController@initTable')
                            ->name('initTable');
                        Route::get('getTableData', 'PermissionGroupController@getTableData')
                            ->name('getTableData');
                        Route::get('exportExcel', 'PermissionGroupController@exportExcel')
                            ->name('exportExcel');
                    });

                Route::resource('permissionGroups', 'PermissionGroupController', ['except' => ['show']]);

                Route::prefix('permissions')->as('permissions.')
                    ->group(function () {
                        Route::get('initTable', 'PermissionController@initTable')
                            ->name('initTable');
                        Route::get('getTableData', 'PermissionController@getTableData')
                            ->name('getTableData');
                        Route::get('exportExcel', 'PermissionController@exportExcel')
                            ->name('exportExcel');
                    });

                Route::resource('permissions', 'PermissionController', ['except' => ['show']]);

                Route::prefix('resourcePermissions')->as('resourcePermissions.')
                    ->group(function () {
                        Route::get('create', 'ResourceController@create')
                            ->name('create');
                        Route::post('', 'ResourceController@store')
                            ->name('store');
                    });
            });
    });
