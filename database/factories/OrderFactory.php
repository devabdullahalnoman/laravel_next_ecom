<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $buyer = User::factory()->buyer();
        $product = Product::factory();

        return [
            'buyer_id' => $buyer,
            'product_id' => $product,
            'quantity' => $this->faker->numberBetween(1, 5),
            'total_price' => $product->price ?? $this->faker->randomFloat(2, 10, 500),
            'buyer_name' => $buyer->name ?? $this->faker->name(),
            'buyer_email' => $buyer->email ?? $this->faker->safeEmail(),
            'buyer_phone' => $buyer->phone ?? $this->faker->phoneNumber(),
            'buyer_address' => $buyer->address ?? $this->faker->address(),
            'order_status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered']),
        ];
    }
}
