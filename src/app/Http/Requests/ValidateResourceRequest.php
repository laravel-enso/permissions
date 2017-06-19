<?php

namespace LaravelEnso\PermissionManager\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateResourceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'prefix' => 'required',
            'permission_group_id' => 'required|exists:permission_groups,id',
        ];
    }
}
