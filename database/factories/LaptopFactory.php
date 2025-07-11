<?php

namespace Database\Factories;

use App\Models\Laptop;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaptopFactory extends Factory
{
    protected $model = Laptop::class;

    public function definition(): array
    {
        return [
            'brand_id' => Brand::inRandomOrder()->first()?->id ?? Brand::factory(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'model' => $this->faker->bothify('Model-###'),
            'price' => $this->faker->randomFloat(2, 500, 3000),
            'stock' => $this->faker->numberBetween(10, 100),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }
}