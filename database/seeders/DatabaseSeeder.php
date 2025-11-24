<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\SellerApplication;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1 Admin
        User::factory()->admin()->create([
            'email' => 'admin@example.com',
        ]);

        // 5 Sellers with fixed emails
        $sellers = User::factory()->count(5)->seller()->sequence(
            ['email' => 'seller1@example.com'],
            ['email' => 'seller2@example.com'],
            ['email' => 'seller3@example.com'],
            ['email' => 'seller4@example.com'],
            ['email' => 'seller5@example.com'],
        )->create();

        // Each seller gets 5 products
        foreach ($sellers as $seller) {
            Product::factory()->count(5)->create([
                'seller_id' => $seller->id,
            ]);
        }

        // 10 Buyers with fixed emails
        $buyers = User::factory()->count(10)->buyer()->sequence(
            ['email' => 'buyer1@example.com'],
            ['email' => 'buyer2@example.com'],
            ['email' => 'buyer3@example.com'],
            ['email' => 'buyer4@example.com'],
            ['email' => 'buyer5@example.com'],
            ['email' => 'buyer6@example.com'],
            ['email' => 'buyer7@example.com'],
            ['email' => 'buyer8@example.com'],
            ['email' => 'buyer9@example.com'],
            ['email' => 'buyer10@example.com'],
        )->create();

        // Each buyer gets carts, orders, and seller applications
        foreach ($buyers as $buyer) {
            Cart::factory()->count(2)->create(['buyer_id' => $buyer->id]);
            Order::factory()->count(2)->create(['buyer_id' => $buyer->id]);
            SellerApplication::factory()->create(['buyer_id' => $buyer->id]);
        }
    }
}
