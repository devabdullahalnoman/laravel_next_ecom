<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request, CartService $service)
    {
        $this->authorize('viewAny', Cart::class);

        $user = $request->user();
        $cartItems = $service->getCartItems($user);

        return view('buyer.cart', compact('cartItems'));
    }

    public function store(CartRequest $request, Product $product, CartService $service)
    {
        $this->authorize('create', Cart::class);

        $user = $request->user();
        $quantity = $request->input('quantity', 1);
        $service->addToCart($user, $product, $quantity);

        return redirect()->route('cart.index');
    }

    public function update(CartRequest $request, Cart $cart, CartService $service)
    {
        $this->authorize('update', $cart);

        $service->updateQuantity($cart, $request->validated()['quantity']);

        return back();
    }

    public function destroy(Cart $cart, CartService $service)
    {
        $this->authorize('delete', $cart);

        $service->removeFromCart($cart);

        return back();
    }
}
