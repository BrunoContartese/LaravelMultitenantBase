<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Tenant\Spatie\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UsersModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionName = 'users';
        $showName = "usuarios";

        Permission::create(['name' => "{$permissionName}.view", 'view_name' => "Ver {$showName}", 'guard_name' => 'api']);
        Permission::create(['name' => "{$permissionName}.create", 'view_name' => "Crear {$showName}", 'guard_name' => 'api']);
        Permission::create(['name' => "{$permissionName}.edit", 'view_name' => "Editar {$showName}", 'guard_name' => 'api']);
        Permission::create(['name' => "{$permissionName}.delete", 'view_name' => "Eliminar {$showName}", 'guard_name' => 'api']);
    }
}
