<?php

namespace App\Http\Controllers\Tenants\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pagination\PaginatorRequest;
use App\Http\Requests\Tenants\DefaultQueryParamsRequest;
use App\Services\Tenants\Administration\UsersService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    private $service;

    public function __construct(UsersService $service)
    {
        $this->service = $service;
    }

    public function index(DefaultQueryParamsRequest $request)
    {
        $users = $this->service->index($request);
        return response()->json($users, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $user = $this->service->store($request);
        return response()->json($user, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $user = $this->service->findById($id);
        return response()->json($user, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $user = $this->service->update($request, $id);
        return response()->json($user, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function restore($id)
    {
        $user = $this->service->restore($id);
        return response()->json($user, Response::HTTP_OK);
    }
}
