<?php

namespace LaravelEnso\PermissionManager\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateResourceRequest extends FormRequest
{
    public function authorize()
    {
        return 'boolean';
    }

    public function rules()
    {
        return [
            'prefix' => 'required',
            'permission_group_id' => 'required|exists:permission_groups,id',
            'index' => 'boolean',
            'create' => 'boolean',
            'store' => 'boolean',
            'show' => 'boolean',
            'edit' => 'boolean',
            'update' => 'boolean',
            'destroy' => 'boolean',
            'initTable' => 'boolean',
            'getTableData' => 'boolean',
            'exportExcel' => 'boolean',
            'selectOptions' => 'boolean',
        ];
    }
}
