<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/system')->as('system.')
    ->namespace('LaravelEnso\PermissionManager\app\Http\Controllers')
    ->group(function () {
        Route::prefix('permissions')->as('permissions.')
            ->group(function () {
                Route::get('initTable', 'PermissionTableController@init')
                    ->name('initTable');
                Route::get('tableData', 'PermissionTableController@data')
                    ->name('tableData');
                Route::get('exportExcel', 'PermissionTableController@excel')
                    ->name('exportExcel');
            });

        Route::resource('permissions', 'PermissionController', ['except' => ['show', 'index']]);
    });
