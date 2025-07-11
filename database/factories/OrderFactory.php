<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'customer_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'order_date' => now(),
            'total_amount' => $this->faker->randomFloat(2, 500, 5000),
            'payment_method' => $this->faker->randomElement(['cash', 'credit_card', 'paypal']),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'shipped', 'delivered', 'cancelled']),
        ];
    }
}
