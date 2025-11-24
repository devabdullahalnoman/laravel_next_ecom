<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerApplicationRequest;
use App\Http\Requests\UpdateSellerApplicationRequest;
use App\Models\SellerApplication;
use App\Services\SellerApplicationService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SellerApplicationController extends Controller
{
    use AuthorizesRequests;

    public function create(SellerApplicationRequest $request)
    {
        $buyer = $request->user();

        return view('buyer.apply', compact('buyer'));
    }

    public function store(SellerApplicationRequest $request, SellerApplicationService $service)
    {
        $user = $request->user();
        $service->apply($user);

        return redirect()->route('buyer.dashboard');
    }

    public function update(UpdateSellerApplicationRequest $request, SellerApplication $application, SellerApplicationService $service)
    {
        $this->authorize('update', $application);

        if ($request->action === 'approve') {
            $service->approve($application);
        } else {
            $service->reject($application);
        }

        return redirect()->route('admin.dashboard');
    }

    public function destroy(SellerApplication $application, SellerApplicationService $service)
    {
        $this->authorize('delete', $application);

        $service->delete($application);

        return redirect()->route('admin.dashboard')
            ->with('status', 'Application deleted.');
    }
}
