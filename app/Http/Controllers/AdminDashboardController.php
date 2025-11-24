<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Services\AdminDashboardService;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\SellerApplication;
use App\Services\SellerApplicationService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminDashboardController extends Controller
{
    use AuthorizesRequests;

    public function index(User $user, Product $product, SellerApplication $application, AdminDashboardService $adminService, SellerApplicationService $applicationService)
    {
        $this->authorize('viewAny', SellerApplication::class);

        $this->authorize('viewAny', Product::class);

        $users        = $adminService->listUsers($user);
        $products     = $adminService->listProducts($product);
        $applications = $applicationService->listApplications($application);

        return view('admin.dashboard', compact('users', 'products', 'applications'));
    }

    public function updateUser(UpdateUserRoleRequest $request, User $user, AdminDashboardService $service)
    {
        $this->authorize('update', $user);

        $service->updateUserRole($user, $request->validated()['role']);
        return back();
    }

    public function deleteUser(User $user, AdminDashboardService $service)
    {
        $this->authorize('delete', $user);

        $service->deleteUser($user);
        return back();
    }

    public function deleteProduct(Product $product, AdminDashboardService $service)
    {
        $this->authorize('delete', $product);

        $service->deleteProduct($product);
        return back();
    }

    public function productOrders(Product $product, AdminDashboardService $service)
    {
        $this->authorize('view', $product);

        $orders = $service->productOrderHistory($product);
        return view('admin.product_orders', compact('product', 'orders'));
    }
}
