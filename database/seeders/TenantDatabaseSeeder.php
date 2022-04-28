<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('optimize:clear');

        /*Roles & Permissions*/
        $this->call(UsersModulePermissionsSeeder::class);
        $this->call(RolesTableSeeder::class);

        /*Table seeders*/
        $this->call(UsersTableSeeder::class);



    }
}
