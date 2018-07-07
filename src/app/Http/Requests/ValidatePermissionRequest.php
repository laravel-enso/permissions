<?php

namespace LaravelEnso\PermissionManager\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $nameUnique = Rule::unique('permissions', 'name');

        $nameUnique = request()->getMethod() === 'PATCH'
            ? $nameUnique->ignore($this->route('permission')->id)
            : $nameUnique;

        return [
            'permission_group_id' => 'required',
            'name' => ['required', $nameUnique],
            'description' => 'required',
            'type' => 'required',
            'is_default' => 'required',
            'roleList' => 'array',
        ];
    }
}
