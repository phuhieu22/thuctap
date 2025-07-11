<?php

namespace Database\Factories;

use App\Models\LaptopPromotion;
use App\Models\Laptop;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaptopPromotionFactory extends Factory
{
    protected $model = LaptopPromotion::class;

    public function definition(): array
    {
        $startDate = $this->faker->optional()->dateTimeBetween('-1 month', '+1 month');
        $endDate = $startDate ? $this->faker->dateTimeBetween($startDate, '+2 months') : null;

        return [
            'laptop_id' => Laptop::inRandomOrder()->first()?->id ?? Laptop::factory(),
            'promotion_id' => Promotion::inRandomOrder()->first()?->id ?? Promotion::factory(),
            'start_date' => $startDate ? $startDate->format('Y-m-d') : null,
            'end_date' => $endDate ? $endDate->format('Y-m-d') : null,
        ];
    }
}
