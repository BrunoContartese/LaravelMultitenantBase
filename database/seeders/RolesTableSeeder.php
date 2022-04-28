<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Tenant\Spatie\Permission;
use App\Models\Tenant\Spatie\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'Administrador',
            'guard_name' => 'api',
        ]);

        $role->syncPermissions(Permission::all());
    }
}
