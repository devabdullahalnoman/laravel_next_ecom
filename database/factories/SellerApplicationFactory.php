<?php

namespace Database\Factories;

use App\Models\SellerApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerApplicationFactory extends Factory
{
    protected $model = SellerApplication::class;

    public function definition(): array
    {
        return [
            'buyer_id' => User::factory()->buyer(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'notes' => $this->faker->sentence(),
        ];
    }
}
