<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/system/permissions')->as('system.permissions.')
    ->namespace('LaravelEnso\Permissions\app\Http\Controllers')
    ->group(function () {
        Route::get('create', 'Create')->name('create');
        Route::post('', 'Store')->name('store');
        Route::get('{permission}/edit', 'Edit')->name('edit');
        Route::patch('{permission}', 'Update')->name('update');
        Route::delete('{permission}', 'Destroy')->name('destroy');

        Route::get('initTable', 'Table@init')->name('initTable');
        Route::get('tableData', 'Table@data')->name('tableData');
        Route::get('exportExcel', 'Table@excel')->name('exportExcel');
    });
