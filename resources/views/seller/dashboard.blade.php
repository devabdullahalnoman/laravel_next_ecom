<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-6">
        {{-- Total Product Count --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <p class="text-gray-700 text-lg">
                    {{ __('Total Products') }}: <span class="font-semibold">{{ $totalProducts }}</span>
                </p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Your Products') }}</h3>
                    <a href="{{ route('seller.product.create') }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        {{ __('Add Product') }}
                    </a>
                </div>
                <table class="w-full table-auto text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border-b">{{ __('Image') }}</th>
                            <th class="px-4 py-2 border-b">{{ __('Title') }}</th>
                            <th class="px-4 py-2 border-b">{{ __('Price') }}</th>
                            <th class="px-4 py-2 border-b">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listSellerProducts as $product)
                        <tr>
                            <td class="px-4 py-2 border-b">
                                @if ($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->title }}" class="h-12 w-12 object-cover rounded">
                                @else
                                <span class="text-gray-400 italic">{{ __('No image') }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border-b">{{ $product->title }}</td>
                            <td class="px-4 py-2 border-b">${{ number_format($product->price, 2) }}</td>
                            <td class="px-4 py-2 border-b space-x-2">
                                <a href="{{ route('product.show', $product) }}"
                                    class="text-blue-600 hover:underline">{{ __('View') }}</a>
                                <a href="{{ route('seller.product.edit', $product) }}"
                                    class="text-indigo-600 hover:underline">{{ __('Edit') }}</a>
                                <form action="{{ route('seller.product.destroy', $product) }}"
                                    method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                {{ __('No products found.') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $listSellerProducts->withQueryString()->links() }}
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h2 class="text-xl font-bold mb-4">{{ __('Order History') }}</h2>
                @forelse ($sellerOrders as $order)
                <div class="border p-4 rounded mb-4">
                    <p><strong>Product:</strong> {{ $order->product->title }}</p>
                    <p><strong>Buyer:</strong> {{ $order->buyer_name }} ({{ $order->buyer_email }})</p>
                    <p><strong>Phone:</strong> {{ $order->buyer_phone ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $order->buyer_address }}</p>
                    <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                    <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($order->order_status) }}</p>
                    <form action="{{ route('seller.order.updateStatus', $order) }}" method="POST" class="mt-2">
                        @csrf
                        @method('PATCH')
                        <label for="order_status_{{ $order->id }}" class="block text-sm font-medium text-gray-700">
                            {{ __('Update Status') }}
                        </label>
                        <select name="order_status" id="order_status_{{ $order->id }}"
                            class="mt-1 block w-full max-w-xs rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach (['pending', 'processing', 'shipped', 'delivered'] as $status)
                            <option value="{{ $status }}" @selected($order->order_status === $status)>
                                {{ ucfirst($status) }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="mt-2 px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                            {{ __('Update') }}
                        </button>
                    </form>
                </div>
                @empty
                <p class="text-gray-500">{{ __('No orders yet.') }}</p>
                @endforelse
                <div class="mt-5">
                    {{ $sellerOrders->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>