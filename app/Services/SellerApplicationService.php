<?php

namespace App\Services;

use App\Models\User;
use App\Models\SellerApplication;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SellerApplicationService
{
    public function apply(User $buyer): SellerApplication
    {
        return SellerApplication::create([
            'buyer_id' => $buyer->id,
            'status' => 'pending',
        ]);
    }

    public function listApplications(SellerApplication $application): LengthAwarePaginator
    {
        return $application->with('buyer')->latest()->paginate(10, ['*'], 'applicationsPage');
    }

    public function approve(SellerApplication $application): SellerApplication
    {
        $application->update(['status' => 'approved']);
        $application->buyer->update(['role' => 'seller']);
        return $application->refresh();
    }

    public function reject(SellerApplication $application): SellerApplication
    {
        $application->update(['status' => 'rejected']);
        return $application->refresh();
    }

    public function delete(SellerApplication $application): void
    {
        $application->delete();
    }
}
