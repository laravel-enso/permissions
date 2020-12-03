<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\Permissions\Http\Controllers\Create;
use LaravelEnso\Permissions\Http\Controllers\Destroy;
use LaravelEnso\Permissions\Http\Controllers\Edit;
use LaravelEnso\Permissions\Http\Controllers\Store;
use LaravelEnso\Permissions\Http\Controllers\Table;
use LaravelEnso\Permissions\Http\Controllers\Update;
use LaravelEnso\Tables\Services\RouteBuilder;

Route::middleware(['api', 'auth', 'core'])
    ->prefix('api/system/permissions')->as('system.permissions.')
    ->group(function () {
        Route::get('create', Create::class)->name('create');
        Route::post('', Store::class)->name('store');
        Route::get('{permission}/edit', Edit::class)->name('edit');
        Route::patch('{permission}', Update::class)->name('update');
        Route::delete('{permission}', Destroy::class)->name('destroy');

        (new RouteBuilder(Table::class))->withExport()->build();
    });
