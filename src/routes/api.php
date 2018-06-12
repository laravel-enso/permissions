<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/system')->as('system.')
    ->namespace('LaravelEnso\PermissionManager\app\Http\Controllers')
    ->group(function () {
        Route::prefix('permissionGroups')->as('permissionGroups.')
            ->group(function () {
                Route::get('initTable', 'PermissionGroupTableController@init')
                    ->name('initTable');
                Route::get('getTableData', 'PermissionGroupTableController@data')
                    ->name('getTableData');
                Route::get('exportExcel', 'PermissionGroupTableController@excel')
                    ->name('exportExcel');
            });

        Route::resource('permissionGroups', 'PermissionGroupController', ['except' => ['show', 'index']]);

        Route::prefix('permissions')->as('permissions.')
            ->group(function () {
                Route::get('initTable', 'PermissionTableController@init')
                    ->name('initTable');
                Route::get('getTableData', 'PermissionTableController@data')
                    ->name('getTableData');
                Route::get('exportExcel', 'PermissionTableController@excel')
                    ->name('exportExcel');
            });

        Route::resource('permissions', 'PermissionController', ['except' => ['show', 'index']]);

        Route::prefix('resourcePermissions')->as('resourcePermissions.')
            ->group(function () {
                Route::get('create', 'ResourceController@create')
                    ->name('create');
                Route::post('', 'ResourceController@store')
                    ->name('store');
            });
    });
