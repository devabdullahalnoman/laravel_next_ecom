<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="w-11/12 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
            <div class="bg-white p-4 rounded shadow-md shadow-gray-500">
                @if ($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->title }}"
                    class="w-full h-48 object-cover rounded mb-4">
                @endif

                <h3 class="text-lg font-semibold text-gray-800">{{ $product->title }}</h3>
                <p class="text-gray-600 mb-2">${{ number_format($product->price, 2) }}</p>

                <a href="{{ route('product.show', $product) }}"
                    class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    {{ __('View') }}
                </a>
            </div>
            @empty
            <p class="text-gray-500 col-span-full text-center">{{ __('No products available.') }}</p>
            @endforelse
        </div>
        <div class="mt-5">
            {{ $products->links() }}
        </div>
    </div>
</x-guest-layout>