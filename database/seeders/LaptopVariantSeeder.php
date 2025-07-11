<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LaptopVariant; // Assuming you have a LaptopVariant model

class LaptopVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LaptopVariant::factory(10)->create();
    }
}

// This seeder will create 10 random laptop variants using the LaptopVariantFactory.
