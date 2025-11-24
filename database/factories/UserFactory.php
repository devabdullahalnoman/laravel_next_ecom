<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password', // default password
            'role' => 'buyer', // default role
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }

    public function admin()
    {
        return $this->state(fn() => [
            'role' => 'admin',
            'password' => 'admin123',
        ]);
    }

    public function seller()
    {
        return $this->state(fn() => [
            'role' => 'seller',
            'password' => 'seller123',
        ]);
    }

    public function buyer()
    {
        return $this->state(fn() => [
            'role' => 'buyer',
            'password' => 'buyer123',
        ]);
    }
}
