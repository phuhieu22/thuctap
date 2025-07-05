<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Laptop;
use Illuminate\Database\Seeder;

class BasicDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create brands
        $brands = [
            'Apple',
            'Dell',
            'HP',
            'Lenovo',
            'Asus',
        ];

        foreach ($brands as $brandName) {
            Brand::firstOrCreate(['name' => $brandName]);
        }

        // Create categories
        $categories = [
            'Gaming',
            'Business',
            'Ultrabook',
            'Workstation',
            'Budget',
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(['name' => $categoryName]);
        }

        // Create sample laptops
        $laptops = [
            [
                'brand_id' => 1, // Apple
                'category_id' => 3, // Ultrabook
                'model' => 'MacBook Air M2',
                'price' => 1299.99,
                'stock' => 25,
                'description' => 'Lightweight laptop with M2 chip for everyday computing.'
            ],
            [
                'brand_id' => 2, // Dell
                'category_id' => 1, // Gaming
                'model' => 'Alienware X17',
                'price' => 2499.99,
                'stock' => 10,
                'description' => 'High-performance gaming laptop with RTX graphics.'
            ],
            [
                'brand_id' => 3, // HP
                'category_id' => 2, // Business
                'model' => 'EliteBook 850',
                'price' => 1599.99,
                'stock' => 15,
                'description' => 'Professional business laptop with enterprise features.'
            ],
            [
                'brand_id' => 4, // Lenovo
                'category_id' => 4, // Workstation
                'model' => 'ThinkPad P1',
                'price' => 3299.99,
                'stock' => 8,
                'description' => 'Mobile workstation for demanding professional tasks.'
            ],
            [
                'brand_id' => 5, // Asus
                'category_id' => 5, // Budget
                'model' => 'VivoBook 15',
                'price' => 599.99,
                'stock' => 30,
                'description' => 'Affordable laptop for students and everyday use.'
            ],
        ];

        foreach ($laptops as $laptopData) {
            Laptop::firstOrCreate(
                ['model' => $laptopData['model']],
                $laptopData
            );
        }
    }
}
