<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingAddress;

class ShippingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingAddress::factory()
            ->count(10)
            ->create();
    }
}

// This code is a Laravel Seeder for the ShippingAddress model. It uses the ShippingAddressFactory to create 10 shipping address records in the database when the run method is called. The Seeder is part of the Database\Seeders namespace and can be executed using artisan commands to populate the database with sample data for testing or development purposes.
