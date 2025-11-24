<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class BuyerDashboardService
{
    public function orderHistory(User $buyer): LengthAwarePaginator
    {
        return $buyer->orders()->with('product')->latest()->paginate(5, ['*'], 'orderPage');
    }
}
