<?php

namespace Database\Factories;

use App\Models\LaptopVariant;
use App\Models\Laptop;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaptopVariantFactory extends Factory
{
    protected $model = LaptopVariant::class;

    public function definition(): array
    {
        return [
            'laptop_id' => Laptop::inRandomOrder()->first()?->id ?? Laptop::factory(),
            'variant_name' => $this->faker->randomElement(['8GB RAM', '16GB RAM', '512GB SSD', '1TB HDD']),
            'price' => $this->faker->randomFloat(2, 600, 3500),
            'stock' => $this->faker->numberBetween(5, 50),
            'specifications' => $this->faker->optional()->sentence(10),
        ];
    }
}
