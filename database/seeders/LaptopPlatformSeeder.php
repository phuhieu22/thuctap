<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Laptop;
use App\Models\LaptopVariant;
use App\Models\Promotion;
use Illuminate\Database\Seeder;

class LaptopPlatformSeeder extends Seeder
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
            'Acer',
            'MSI',
            'Razer'
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
            '2-in-1',
            'Creative',
            'Student'
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(['name' => $categoryName]);
        }

        // Create promotions
        $promotions = [
            [
                'name' => 'Summer Sale',
                'description' => 'Great deals for summer',
                'discount_percentage' => 15.00,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
            ],
            [
                'name' => 'Back to School',
                'description' => 'Special prices for students',
                'discount_percentage' => 10.00,
                'start_date' => now(),
                'end_date' => now()->addDays(60),
            ],
            [
                'name' => 'Black Friday',
                'description' => 'Huge discounts on all laptops',
                'discount_percentage' => 25.00,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
            ]
        ];

        foreach ($promotions as $promotionData) {
            Promotion::firstOrCreate(
                ['name' => $promotionData['name']],
                $promotionData
            );
        }

        // Get created data for relationships
        $appleBrand = Brand::where('name', 'Apple')->first();
        $dellBrand = Brand::where('name', 'Dell')->first();
        $hpBrand = Brand::where('name', 'HP')->first();
        
        $gamingCategory = Category::where('name', 'Gaming')->first();
        $businessCategory = Category::where('name', 'Business')->first();
        $ultrabookCategory = Category::where('name', 'Ultrabook')->first();

        // Create sample laptops
        $laptops = [
            [
                'model' => 'MacBook Pro 16"',
                'brand_id' => $appleBrand->id,
                'category_id' => $ultrabookCategory->id,
                'price' => 2499.00,
                'stock' => 10,
                'description' => 'Powerful laptop for professionals with M2 Pro chip',
                'variants' => [
                    ['variant_name' => 'M2 Pro 512GB', 'price' => 2499.00, 'stock' => 5, 'specifications' => 'M2 Pro, 16GB RAM, 512GB SSD'],
                    ['variant_name' => 'M2 Pro 1TB', 'price' => 2799.00, 'stock' => 3, 'specifications' => 'M2 Pro, 16GB RAM, 1TB SSD'],
                    ['variant_name' => 'M2 Max 1TB', 'price' => 3499.00, 'stock' => 2, 'specifications' => 'M2 Max, 32GB RAM, 1TB SSD'],
                ]
            ],
            [
                'model' => 'XPS 13',
                'brand_id' => $dellBrand->id,
                'category_id' => $ultrabookCategory->id,
                'price' => 1299.00,
                'stock' => 15,
                'description' => 'Premium ultrabook with stunning display',
                'variants' => [
                    ['variant_name' => 'i5 256GB', 'price' => 1299.00, 'stock' => 8, 'specifications' => 'Intel i5-1240P, 8GB RAM, 256GB SSD'],
                    ['variant_name' => 'i7 512GB', 'price' => 1599.00, 'stock' => 5, 'specifications' => 'Intel i7-1260P, 16GB RAM, 512GB SSD'],
                    ['variant_name' => 'i7 1TB', 'price' => 1899.00, 'stock' => 2, 'specifications' => 'Intel i7-1260P, 16GB RAM, 1TB SSD'],
                ]
            ],
            [
                'model' => 'Pavilion Gaming 15',
                'brand_id' => $hpBrand->id,
                'category_id' => $gamingCategory->id,
                'price' => 899.00,
                'stock' => 20,
                'description' => 'Affordable gaming laptop with dedicated graphics',
                'variants' => [
                    ['variant_name' => 'GTX 1650 8GB', 'price' => 899.00, 'stock' => 12, 'specifications' => 'Intel i5-11400H, 8GB RAM, GTX 1650, 512GB SSD'],
                    ['variant_name' => 'RTX 3050 16GB', 'price' => 1199.00, 'stock' => 6, 'specifications' => 'Intel i7-11800H, 16GB RAM, RTX 3050, 512GB SSD'],
                    ['variant_name' => 'RTX 3060 16GB', 'price' => 1499.00, 'stock' => 2, 'specifications' => 'Intel i7-11800H, 16GB RAM, RTX 3060, 1TB SSD'],
                ]
            ]
        ];

        foreach ($laptops as $laptopData) {
            $variants = $laptopData['variants'];
            unset($laptopData['variants']);
            
            $laptop = Laptop::firstOrCreate(
                ['model' => $laptopData['model']],
                $laptopData
            );

            // Create variants
            foreach ($variants as $variantData) {
                LaptopVariant::firstOrCreate(
                    [
                        'laptop_id' => $laptop->id,
                        'variant_name' => $variantData['variant_name']
                    ],
                    array_merge($variantData, ['laptop_id' => $laptop->id])
                );
            }

            // Attach random promotions
            $randomPromotions = Promotion::inRandomOrder()->take(rand(0, 2))->pluck('id');
            $laptop->promotions()->sync($randomPromotions);
        }

        $this->command->info('Laptop platform seeded successfully!');
    }
}
