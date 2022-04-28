<?php

namespace App\Http\Requests\Tenants\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Debe ingresar su correo electrónico.',
            'email.email' => 'La dirección de correo electrónico es inválida.',
            'password.required' => 'Debe ingresar su contraseña.',
        ];
    }
}
