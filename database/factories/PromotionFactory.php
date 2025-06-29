<?php

namespace Database\Factories;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    protected $model = Promotion::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+2 months');

        return [
            'name' => $this->faker->catchPhrase(),
            'discount_percentage' => $this->faker->randomFloat(2, 0, 100),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ];
    }
}
