<?php

namespace Database\Seeders;

use App\Models\LaptopVariant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            LaptopSeeder::class,
            LaptopVariantSeeder::class,
            LaptopImageSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            PaymentSeeder::class,
            ShippingAddressSeeder::class,
            PromotionSeeder::class,
            LaptopPromotionSeeder::class,
            ReviewSeeder::class,
        ]);
    }
};
