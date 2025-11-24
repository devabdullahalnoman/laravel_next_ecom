<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use AuthorizesRequests;

    public function create(Product $product)
    {
        $this->authorize('create', Order::class);

        $buyer = Auth::user();
        $mode = 'single';

        return view('orders.Checkout', compact('mode', 'product', 'buyer'));
    }

    public function store(OrderRequest $request, Product $product, OrderService $service)
    {
        $this->authorize('create', Order::class);

        $user = $request->user();
        $order = $service->placeOrder($user, $product, $request->validated());

        return redirect()->route('orders.show', $order);
    }

    public function createFromCart(Product $product, CartService $cartService)
    {
        $this->authorize('create', Order::class);

        $buyer = Auth::user();
        $mode = 'cart';
        $cartItems = $cartService->getCartItemsByProduct($buyer, $product);

        return view('orders.Checkout', compact('mode', 'cartItems', 'buyer', 'product'));
    }

    public function storeFromCart(OrderRequest $request, Product $product, OrderService $service)
    {
        $this->authorize('create', Order::class);

        $user = $request->user();
        $order = $service->placeOrdersFromCart($user, $product, $request->validated());

        return redirect()->route('orders.show', $order);
    }


    public function show(Order $order)
    {
        $this->authorize('view', $order);

        return view('orders.Confirmation', compact('order'));
    }
}
