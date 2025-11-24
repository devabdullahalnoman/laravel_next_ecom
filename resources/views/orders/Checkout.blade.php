<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            @if ($mode === 'single')
            <h3 class="text-lg font-bold mb-4">{{ $product->title }}</h3>
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            @elseif ($mode === 'cart')
            <h3 class="text-lg font-bold mb-4">{{ __('Items in Your Cart') }}</h3>
            @foreach ($cartItems as $item)
            <p><strong>{{ $item->product->title }}</strong> × {{ $item->quantity }}</p>
            @endforeach
            @endif
            <form method="POST"
                action="{{ $mode === 'single' ? route('order.store', $product) : route('cart.checkout.submit', $product) }}"
                class="space-y-4 mt-6">
                @csrf
                @if ($mode === 'single')
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @endif
                <div>
                    <label for="buyer_name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                    <input id="buyer_name" type="text" name="buyer_name"
                        value="{{ old('buyer_name', $buyer->name) }}"
                        class="mt-1 w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="buyer_email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                    <input id="buyer_email" type="email" name="buyer_email"
                        value="{{ old('buyer_email', $buyer->email) }}"
                        class="mt-1 w-full border rounded p-2" required>
                </div>
                <div>
                    <label for="buyer_phone" class="block text-sm font-medium text-gray-700">{{ __('Phone') }}</label>
                    <input id="buyer_phone" type="text" name="buyer_phone"
                        value="{{ old('buyer_phone', $buyer->phone) }}"
                        class="mt-1 w-full border rounded p-2">
                </div>
                <div>
                    <label for="buyer_address" class="block text-sm font-medium text-gray-700">{{ __('Shipping Address') }}</label>
                    <textarea id="buyer_address" name="buyer_address" rows="3"
                        class="mt-1 w-full border rounded p-2"
                        required>{{ old('buyer_address', $buyer->address) }}</textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    {{ $mode === 'single' ? __('Confirm Order') : __('Place Orders') }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>