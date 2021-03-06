<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DefaultTenantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('optimize:clear');
        $tenant1 = Company::create(['id' => 'tenant1']);
        $tenant1->domains()->create(['domain' => 'tenant1.salescrm-api.test']);

        $tenant2 = Company::create(['id' => 'tenant2']);
        $tenant2->domains()->create(['domain' => 'tenant2.salescrm-api.test']);
    }
}
