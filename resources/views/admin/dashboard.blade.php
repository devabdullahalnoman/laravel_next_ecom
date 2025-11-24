<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Admin Dashboard</h2>
    </x-slot>

    <div class="space-y-8">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Users</h3>
            <table class="w-full border-collapse mb-5">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Role</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                        <td class="border px-4 py-2">
                            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="inline">
                                @csrf @method('PUT')
                                <select name="role" class="border rounded">
                                    <option value="buyer" @selected($user->role === 'buyer')>Buyer</option>
                                    <option value="seller" @selected($user->role === 'seller')>Seller</option>
                                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                </select>
                                <button class="ml-2 px-3 py-1 bg-blue-600 text-white rounded">Update</button>
                            </form>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline ml-2">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->withQueryString()->links() }}
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Products</h3>
            <table class="w-full border-collapse mb-5">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Seller</th>
                        <th class="border px-4 py-2">Price</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="border px-4 py-2">{{ $product->title }}</td>
                        <td class="border px-4 py-2">{{ $product->seller->name ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $product->price }}</td>
                        <td class="border px-4 py-2">
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                            </form>
                            <a href="{{ route('admin.products.orders', $product) }}" class="ml-2 px-3 py-1 bg-green-600 text-white rounded">
                                Orders
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->withQueryString()->links() }}
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Seller Applications</h3>
            <table class="w-full border-collapse mb-5">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Buyer</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                    <tr>
                        <td class="border px-4 py-2">{{ $application->buyer->name }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($application->status) }}</td>
                        <td class="border px-4 py-2">
                            <form method="POST" action="{{ route('admin.applications.update', $application) }}" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="action" value="approve">
                                <button class="px-3 py-1 bg-blue-600 text-white rounded">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.applications.update', $application) }}" class="inline ml-2">
                                @csrf @method('PUT')
                                <input type="hidden" name="action" value="reject">
                                <button class="px-3 py-1 bg-yellow-600 text-white rounded">Reject</button>
                            </form>
                            <form method="POST" action="{{ route('admin.applications.destroy', $application) }}" class="inline ml-2">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $applications->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>