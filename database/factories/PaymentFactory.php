<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()?->id ?? Order::factory(),
            'amount' => $this->faker->randomFloat(2, 500, 5000),
            'payment_date' => now(),
            'status' => $this->faker->randomElement(['unpaid', 'paid', 'failed', 'refunded']),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer', 'cash']),
        ];
    }
}
