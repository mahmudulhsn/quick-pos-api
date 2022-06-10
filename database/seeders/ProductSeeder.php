<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => "Boots Regular Tampon",
            'price' => 680,
            'quantity' => 50,
        ]);
        Product::create([
            'name' => "Boots Super Tampon",
            'price' => 680,
            'quantity' => 50,
        ]);
        Product::create([
            'name' => "ASDA Regular Tampon",
            'price' => 480,
            'quantity' => 30,
        ]);
    }
}
