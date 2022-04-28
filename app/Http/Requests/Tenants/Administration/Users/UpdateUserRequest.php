<?php

namespace App\Http\Requests\Tenants\Administration\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('users.edit');
    }

    public function rules()
    {
        $rules = User::$rules;
        $rules['email'] = "required|string|email|max:255|unique:users,email,{$this->route()->parameter('user')}";
        $rules['password'] = 'nullable|string|min:6|confirmed';
        return $rules;
    }

    public function messages()
    {
        return User::$messages;
    }
}
