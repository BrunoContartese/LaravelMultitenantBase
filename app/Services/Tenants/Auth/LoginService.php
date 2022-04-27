<?php

namespace App\Services\Tenants\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LoginService
{
    private $relations = [];

    public function login($request)
    {
        if(!Auth::attempt($request->only('email', 'password'))) {
            throw new HttpException(401, 'Credenciales inválidas.');
        }

        return $request->user()->createToken($request->device ?? 'Laravel Password Grant Client')->plainTextToken;
    }
}
