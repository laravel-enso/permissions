<?php

namespace LaravelEnso\PermissionManager\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidatePermissionGroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $nameUnique = Rule::unique('permission_groups', 'name');

        $nameUnique = request()->getMethod() === 'PATCH'
            ? $nameUnique->ignore($this->route('permissionGroup')->id)
            : $nameUnique;

        return [
            'name' => ['required', $nameUnique],
            'description' => 'required',
        ];
    }
}
