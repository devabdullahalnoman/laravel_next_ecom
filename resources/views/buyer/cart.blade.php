<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Cart') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            @forelse ($cartItems as $item)
            <div id="cart-item-{{ $item->id }}" class="border-b pb-4 mb-4">
                <h3 class="text-lg font-semibold">{{ $item->product->title }}</h3>
                <p><strong>Price:</strong> ${{ number_format($item->product->price, 2) }}</p>
                <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                <p><strong>Total:</strong> ${{ number_format($item->product->price * $item->quantity, 2) }}</p>

                <div class="mt-2 flex items-center space-x-4">
                    <form action="{{ route('cart.update', ['cart' => $item->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                            class="w-16 border rounded px-2 py-1">
                        <button type="submit" class="px-3 py-1 btn btn-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            {{ __('Update') }}
                        </button>
                    </form>

                    <form action="{{ route('cart.destroy', ['cart' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 btn btn-sm bg-red-600 text-white rounded hover:bg-red-700">
                            {{ __('Remove') }}
                        </button>
                    </form>
                    <button class="px-4 py-2 btn btn-sm bg-green-600 text-white rounded hover:bg-green-700">
                        <a href="{{ route('cart.checkout', ['product' => $item->product_id]) }}">
                            {{ __('Checkout This Item') }}
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
                {{ $cartItems->links() }}
            </div>
        </div>
    </div>
</x-app-layout>