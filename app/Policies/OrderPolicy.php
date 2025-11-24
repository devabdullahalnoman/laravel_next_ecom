<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->id === $order->buyer_id || $user->id === $order->product->seller_id;
    }

    public function viewAny(User $user): bool
    {
        return $user->isBuyer() || $user->isSeller();
    }

    public function create(User $user): bool
    {
        return $user->isBuyer();
    }

    public function update(User $user, Order $order): bool
    {
        return $user->id === $order->product->seller_id;
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->id === $order->buyer_id;
    }
}
