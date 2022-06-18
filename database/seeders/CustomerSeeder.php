<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name' => "Customer",
            'phone' => "+8801917200115",
            'email' => 'customer@customer.com',
            'address' => 'Uttara, Dhaka',
        ]);
        Customer::create([
            'name' => "Customer 2",
            'phone' => "+8801917200116",
            'email' => 'customer2@customer.com',
            'address' => 'Uttara, Dhaka',
        ]);
        Customer::create([
            'name' => "Customer 3",
            'phone' => "+8801917200117",
            'email' => 'customer3@customer.com',
            'address' => 'Uttara, Dhaka',
        ]);
    }
}
