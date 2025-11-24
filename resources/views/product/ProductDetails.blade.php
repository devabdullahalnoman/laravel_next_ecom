<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->title }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg space-y-6">
            @if ($product->image)
            <img src="{{ $product->image }}" alt="{{ $product->title }}" class="rounded max-w-70% mx-auto">
            @else
            <div class="text-gray-400 italic">{{ __('No image available') }}</div>
            @endif
            <p class="text-gray-700 text-lg">
                <strong>{{ __('Price') }}:</strong> ${{ number_format($product->price, 2) }}
            </p>
            <p class="text-gray-700">
                <strong>{{ __('Description') }}:</strong><br>
                {{ $product->description ?? __('No description provided.') }}
            </p>
            <p class="text-gray-600 text-sm">
                <strong>{{ __('Seller') }}:</strong> {{ $product->seller->name ?? __('Unknown') }}
            </p>
            @auth
            @if (auth()->user()->id === $product->seller_id)
            <div class="flex space-x-4 mt-6">
                <a href="{{ route('seller.product.edit', $product) }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    {{ __('Edit') }}
                </a>

                <form action="{{ route('seller.product.destroy', $product) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
            @endif
            @if (auth()->user()->isBuyer())
            <a href="{{ route('order.create', $product) }}"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 inline-block mt-4">
                {{ __('Order Now') }}
            </a>
            <form action="{{ route('cart.store', $product) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                    {{ __('Add to Cart') }}
                </button>
            </form>
            @endif
            @endauth
            @guest
            @php
            session(['url.intended' => request()->fullUrl()]);
            @endphp
            <a href="{{ route('login') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mt-4 inline-block">
                {{ __('Login to Order') }}
            </a>
            @endguest
        </div>
    </div>
</x-guest-layout>