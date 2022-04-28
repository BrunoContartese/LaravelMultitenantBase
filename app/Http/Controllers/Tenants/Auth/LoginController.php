<?php

namespace App\Http\Controllers\Tenants\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Http\Requests\Tenants\Auth\LoginRequest;
use App\Services\Tenants\Auth\LoginService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    private $service;

    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request)
    {
        $token = $this->service->login($request);
        $response = [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 1440
        ];
        return response()->json($response, Response::HTTP_OK);
    }

}
