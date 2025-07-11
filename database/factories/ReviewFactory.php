<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Laptop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'laptop_id' => Laptop::inRandomOrder()->first()?->id ?? Laptop::factory(),
            'customer_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->optional()->sentence(10),
        ];
    }
}
