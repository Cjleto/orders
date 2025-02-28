<?php

namespace Database\Seeders;

use App\Models\MacroCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MacroCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MacroCategory::factory()->count(10)->create();
    }
}
