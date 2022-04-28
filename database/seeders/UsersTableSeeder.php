<?php

namespace Database\Seeders;

use App\Models\Tenant\Spatie\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();

        $user = User::find(1);
        $user->syncRoles(['Administrador']);
    }
}
