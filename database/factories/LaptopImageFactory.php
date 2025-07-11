<?php

namespace Database\Factories;

use App\Models\LaptopImage;
use App\Models\Laptop;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaptopImageFactory extends Factory
{
    protected $model = LaptopImage::class;

    public function definition(): array
    {
        return [
            'laptop_id' => Laptop::inRandomOrder()->first()?->id ?? Laptop::factory(),
            'url' => $this->faker->imageUrl(640, 480, 'electronics', true, 'laptop'),
        ];
    }
}
