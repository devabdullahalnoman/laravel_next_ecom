<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        return [
            'buyer_id' => User::factory()->buyer(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 3),
        ];
    }
}
