{{-- resources/views/seller/products/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            <form action="{{ route('seller.product.update', $product) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                    <input type="text" name="title" value="{{ old('title', $product->title) }}" class="mt-1 w-full border rounded p-2">
                    @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                    <textarea name="description" class="mt-1 w-full border rounded p-2" rows="4">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Price') }}</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="mt-1 w-full border rounded p-2">
                    @error('price') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ __('Image URL') }}</label>
                    <input type="text" name="image" value="{{ old('image', $product->image) }}" class="mt-1 w-full border rounded p-2">
                    @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    {{ __('Update') }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>