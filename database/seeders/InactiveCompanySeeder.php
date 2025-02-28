<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InactiveCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()
            ->inactive()
            ->hasMacroCategories(5, function (array $attributes, Company $company) {
                return ['company_id' => $company->id];
            })
            ->count(10)
            ->create();

    }
}
