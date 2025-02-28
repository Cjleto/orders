<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use App\Models\MacroCategory;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Database\Seeders\InitialDataSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionsRolesSeeder::class,
            InitialDataSeeder::class,
            BistrotDataSeeder::class,
        ]);

    }
}
