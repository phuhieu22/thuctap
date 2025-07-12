<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Gọi các Seeder nền tảng TRƯỚC
        $this->call([
            RoleSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
        ]);

        // Sau đó tạo user (vì đã có role_id)
        \App\Models\User::factory(10)->create();

        // Gọi LaptopSeeder rồi mới đến LaptopVariantSeeder
        $this->call([
            LaptopSeeder::class,         // 👈 Bắt buộc chạy trước
            LaptopVariantSeeder::class, // 👈 Vì cần có laptop_id
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
}
