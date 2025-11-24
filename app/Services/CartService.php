<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CartService
{
    public function getCartItems(User $buyer): LengthAwarePaginator
    {
        return $buyer->cartItems()->with('product')->paginate(5, ['*'], 'cartPage');
    }

    public function getCartItemsByProduct(User $buyer, Product $product): LengthAwarePaginator
    {
        return $buyer->cartItems()->where('product_id', $product->id)->with('product')->paginate(5, ['*'], 'cartPage');
    }

    public function addToCart(Authenticatable $buyer, Product $product, int $quantity = 1): Cart
    {
        $existing = Cart::where('buyer_id', $buyer->id)->where('product_id', $product->id)->first();

        if ($existing) {
            $existing->increment('quantity', $quantity);
            return $existing->refresh();
        }

        return Cart::create([
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }

    public function updateQuantity(Cart $cart, int $quantity): Cart
    {
        $cart->update(['quantity' => $quantity]);

        return $cart->refresh();
    }

    public function removeFromCart(Cart $cart): void
    {
        $cart->delete();
    }
}
