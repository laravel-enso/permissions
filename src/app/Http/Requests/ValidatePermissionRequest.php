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
        $permission = $this->route('permission');
        $nameUnique = Rule::unique('permissions', 'name');
        $nameUnique = request()->getMethod() === 'PATCH'
            ? $nameUnique->ignore($permission->id)
            : $nameUnique;

        return [
            'permission_group_id' => 'required',
            'name' => ['required', $nameUnique],
            'description' => 'required',
            'type' => 'required',
            'default' => 'required',
        ];
    }
}
