<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buyer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto space-y-8">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">{{ $user->name }}</h3>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">{{ __('Your Cart') }}</h3>
            @forelse ($cartItems as $item)
            <div class="border-b pb-4 mb-4">
                <h4 class="text-md font-semibold">{{ $item->product->title }}</h4>
                <p><strong>Price:</strong> ${{ number_format($item->product->price, 2) }}</p>
                <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                <p><strong>Total:</strong> ${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                <div class="mt-2 flex space-x-4">
                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                            class="w-16 border rounded px-2 py-1">
                        <button type="submit" class="px-3 py-1 btn btn-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            {{ __('Update') }}
                        </button>
                    </form>
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 btn btn-sm bg-red-600 text-white rounded hover:bg-red-700">
                            {{ __('Remove') }}
                        </button>
                    </form>
                    <button class="px-3 py-1 btn btn-sm bg-green-600 text-white rounded hover:bg-green-700">
                        <a href="{{ route('cart.checkout', $item->product_id) }}">
                            {{ __('Checkout') }}
                        </a>
                    </button>
                    <button class="px-3 py-1 btn btn-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                        <a href="{{ route('product.show', $item->product_id) }}">
                            {{ __('View') }}
                        </a>
                    </button>
                </div>
            </div>
            @empty
            <p class="text-gray-500">{{ __('Your cart is empty.') }}</p>
            @endforelse
            <div class="mt-5">
                {{ $cartItems->withQueryString()->links() }}
            </div>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">{{ __('Order History') }}</h3>
            @forelse ($orders as $order)
            <div class="border-b pb-4 mb-4">
                <p><strong>Product:</strong> {{ $order->product->title }}</p>
                <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->order_status) }}</p>
                <div class="mt-2 flex space-x-4">
                    <button class="px-3 py-1 btn btn-sm bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                        <a href="{{ route('orders.show', $order) }}">
                            {{ __('View Order') }}
                        </a>
                    </button>
                    <button class="px-3 py-1 btn btn-sm bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                        <a href="{{ route('product.show', $order->product_id) }}">
                            {{ __('View Product') }}
                        </a>
                    </button>
                </div>
            </div>
            @empty
            <p class="text-gray-500">{{ __('No orders yet.') }}</p>
            @endforelse
            <div class="mt-5">
                {{ $orders->withQueryString()->links() }}
            </div>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <a href="{{ route('seller.apply') }}"
                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                {{ __('Apply as Seller') }}
            </a>
        </div>
    </div>
</x-app-layout>