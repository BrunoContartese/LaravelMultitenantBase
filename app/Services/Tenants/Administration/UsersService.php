<?php

namespace App\Services\Tenants\Administration;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsersService
{
    private $relations = [
        'creator',
        'editor',
        'destroyer'
    ];

    public function index($request)
    {
        $users = User::with($this->relations);

        if($request->trashed != '*' && $request->trashed == 2) {
            $users->onlyTrashed();
        } else if($request->trashed == '*') {
            $users->withTrashed();
        }

        if($request->has("searchQuery")) {
            $users->where('first_name', 'like', '%'.$request->searchQuery.'%')
                ->orWhere('last_name', 'like', '%'.$request->searchQuery.'%')
                ->orWhere('email', 'like', '%'.$request->searchQuery.'%');
        }

        if( $request->has('orderBy') ) {
            $users->orderBy( $request->orderBy, $request->orderDirection );
        }

        if($request->has('paginated') && $request->paginated ) {
            return $users->paginate( $request->perPage );
        }

        return $users->get();
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            $user = User::create($input);

            if($request->has('roles')) {
                $user->syncRoles($request->roles);
            }

            DB::commit();
            return $user;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (UsersService.store): {$e->getMessage()}");
        }
    }

    public function findById($id)
    {
        return User::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::with($this->relations)->findOrFail($id);
            $input = $request->all();
            if($request->has('password')) {
                $input['password'] = Hash::make($input['password']);
            }

            $user->update($input);

            if($request->has('roles')) {
                $user->syncRoles($request->roles);
            }

            DB::commit();
            return $user;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (UsersService.update): {$e->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function restore($id)
    {
        $user = User::withTrashed()->with($this->relations)->findOrFail($id);
        $user->restore();
        return $user;
    }
}
