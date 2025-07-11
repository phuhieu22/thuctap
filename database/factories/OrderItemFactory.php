<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Laptop;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()?->id ?? Order::factory(),
            'laptop_id' => Laptop::inRandomOrder()->first()?->id ?? Laptop::factory(),
            'quantity' => $this->faker->numberBetween(1, 3),
            'price' => $this->faker->randomFloat(2, 500, 3000), // đơn giá
        ];
    }
}
