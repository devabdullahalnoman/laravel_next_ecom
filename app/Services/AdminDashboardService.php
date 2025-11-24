<?php

namespace App\Services;

use App\Models\User;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminDashboardService
{
    public function listUsers(User $user): LengthAwarePaginator
    {
        return $user->paginate(5, ['*'], 'usersPage');
    }

    public function updateUserRole(User $user, string $role): User
    {
        $user->update(['role' => $role]);
        return $user->refresh();
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
    }

    public function listProducts(Product $product): LengthAwarePaginator
    {
        return $product->with('seller')->paginate(10, ['*'], 'productsPage');
    }

    public function deleteProduct(Product $product): void
    {
        $product->delete();
    }

    public function productOrderHistory(Product $product): LengthAwarePaginator
    {
        return $product->orders()->with('buyer')->paginate(10, ['*'], 'ordersPage');
    }
}
