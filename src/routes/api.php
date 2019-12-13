<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/system/permissions')->as('system.permissions.')
    ->namespace('LaravelEnso\Permissions\app\Http\Controllers')
    ->group(function () {
        require 'app/permissions.php';
    });
