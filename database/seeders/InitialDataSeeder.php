<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->admin()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Qwerty7-'),
        ]);

        Customer::factory()->count(10)->create();

        $products = Product::factory()->count(10)->create();

        Order::factory()->randomCreateDate()->count(10)->create()->each(function ($order) {
            // Prendi un numero random di prodotti (tra 1 e 4)
            $products = \App\Models\Product::inRandomOrder()->take(rand(1, 4))->get();

            // Associa i prodotti all'ordine con i dati della pivot
            foreach ($products as $product) {
                $order->products()->attach($product->id, [
                    'quantity' => rand(1, 10), // Quantità casuale
                    'product_name' => $product->name, // Nome dal prodotto
                    'product_price' => $product->price, // Prezzo dal prodotto
                ]);
            }
        });
    }
}
