<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = User::factory()->admin()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Qwerty7-')
        ]);

        $customer = User::factory()->customer()->create([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'password' => bcrypt('Qwerty7-')
        ]);


    }

}
