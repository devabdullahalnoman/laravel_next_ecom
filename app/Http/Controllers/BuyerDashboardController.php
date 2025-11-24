<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Services\BuyerDashboardService;
use App\Services\CartService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BuyerDashboardController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request, BuyerDashboardService $dashboardService, CartService $cartService)
    {
        $this->authorize('viewAny', Order::class);
        $this->authorize('viewAny', Cart::class);

        $user = $request->user();
        $cartItems = $cartService->getCartItems($user);
        $orders = $dashboardService->orderHistory($user);

        return view('buyer.dashboard', compact('user', 'cartItems', 'orders'));
    }
}
