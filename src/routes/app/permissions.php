<?php

Route::get('create', 'Create')->name('create');
Route::post('', 'Store')->name('store');
Route::get('{permission}/edit', 'Edit')->name('edit');
Route::patch('{permission}', 'Update')->name('update');
Route::delete('{permission}', 'Destroy')->name('destroy');

Route::get('initTable', 'InitTable')->name('initTable');
Route::get('tableData', 'TableData')->name('tableData');
Route::get('exportExcel', 'ExportExcel')->name('exportExcel');
