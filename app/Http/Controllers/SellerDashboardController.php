<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\SellerProductService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SellerDashboardController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request, SellerProductService $dashboardService)
    {
        $this->authorize('viewAny', Product::class);
        $this->authorize('viewAny', Order::class);

        $user = $request->user();
        $totalProducts = $dashboardService->sellerTotalProducts($user);
        $listSellerProducts = $dashboardService->listSellerProducts($user);
        $sellerOrders = $dashboardService->getSellerOrders($user);

        return view('seller.dashboard', compact('totalProducts', 'listSellerProducts', 'sellerOrders'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view('seller.product.create');
    }

    public function store(StoreProductRequest $request, SellerProductService $service)
    {
        $this->authorize('create', Product::class);

        $service->create($request->user(), $request->validated());

        return redirect()->route('seller.dashboard');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('seller.product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, SellerProductService $service, Product $product)
    {
        $this->authorize('update', $product);

        $service->update($product, $request->validated());

        return redirect()->route('seller.dashboard');
    }

    public function updateOrderStatus(UpdateOrderStatusRequest $request, Order $order, SellerProductService $service)
    {
        $this->authorize('update', $order);

        $service->updateOrderStatus($order, $request->validated()['order_status']);

        return redirect()->route('seller.dashboard');
    }

    public function destroy(Product $product, SellerProductService $service)
    {
        $this->authorize('delete', $product);

        $service->delete($product);

        return redirect()->route('seller.dashboard');
    }
}
