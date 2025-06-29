<?php

namespace Database\Factories;

use App\Models\ShippingAddress;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingAddressFactory extends Factory
{
    protected $model = ShippingAddress::class;

    public function definition(): array
    {
        return [
            'customer_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'order_id' => Order::inRandomOrder()->first()?->id ?? Order::factory(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
        ];
    }
}
