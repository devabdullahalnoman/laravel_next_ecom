<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SellerProductService
{
    public function listSellerProducts(User $seller): LengthAwarePaginator
    {
        return $seller->products()->paginate(5, ['*'], 'products_page');
    }

    public function sellerTotalProducts(User $seller): int
    {
        return $seller->products()->count();
    }

    public function getSellerOrders(User $seller): LengthAwarePaginator
    {
        return $seller->soldOrders()->paginate(3, ['*'], 'orders_page');
    }

    public function updateOrderStatus(Order $order, string $status): Order
    {
        $order->update(['order_status' => $status]);
        return $order->refresh();
    }

    public function create(User $seller, array $data): Product
    {
        $data['seller_id'] = $seller->id;
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product->refresh();
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
