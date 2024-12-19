<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Tenant\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tenants = Tenant::factory()->createMany([
            ['name' => 'foo'],
            ['name' => 'bar' ]
        ]);

        $tenants->each(fn ($tenant) =>
            $tenant->run(function () {
                User::factory()->create([
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                ]);
            }
        ));
    }
}
