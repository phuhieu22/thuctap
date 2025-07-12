<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserFactory extends Factory
{
    public function definition(): array
{
    return [
        'username' => $this->faker->unique()->userName(),
        'email' => $this->faker->unique()->safeEmail(),
        'password_hash' => bcrypt('password'),
        'name' => $this->faker->name(),
        'phone' => $this->faker->optional()->numerify('0#########'), // Ví dụ: 10 số kiểu Việt Nam
        'address' => $this->faker->optional()->address(),
        'role_id' => 1, // 👈 gán cứng ID đã seed trước
        'created_at' => now(),
        'last_login' => $this->faker->optional()->dateTimeThisMonth(),
    ];
}

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
