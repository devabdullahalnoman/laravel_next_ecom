<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class OrderService
{
    public function placeOrder(Authenticatable $buyer, Product $product, array $data): Order
    {
        return Order::create([
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'total_price' => $product->price,
            'buyer_name' => $data['buyer_name'],
            'buyer_email' => $data['buyer_email'],
            'buyer_phone' => $data['buyer_phone'] ?? null,
            'buyer_address' => $data['buyer_address'],
            'order_status' => 'pending',
        ]);
    }

    public function placeOrdersFromCart(User $buyer, Product $product, array $data): Order
    {
        $cartItem = $buyer->cartItems()->where('product_id', $product->id)->with('product')->firstOrFail();

        $order = Order::create([
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,
            'quantity' => $cartItem->quantity,
            'total_price' => $cartItem->product->price * $cartItem->quantity,
            'buyer_name' => $data['buyer_name'],
            'buyer_email' => $data['buyer_email'],
            'buyer_phone' => $data['buyer_phone'] ?? null,
            'buyer_address' => $data['buyer_address'],
            'order_status' => 'pending',
        ]);

        $cartItem->delete();

        return $order;
    }
}
