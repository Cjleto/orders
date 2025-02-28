<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dish::factory()->count(10)->create();
    }
}
