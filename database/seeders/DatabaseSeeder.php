<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,
            ServiceSeeder::class,
            CountrySeeder::class,
            JobCategorySeeder::class,
            AdminUserSeeder::class,
            RolesAndPermissionsSeeder::class,
            DemoSeeder::class,
            ContentSeeder::class,
            DemoCustomerSeeder::class,
        ]);
    }
}
