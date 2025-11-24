<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Apply as Seller') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <p class="mb-4">
                {{ __('You are currently a buyer. Apply to become a seller and start listing products!') }}
            </p>
            <form method="POST" action="{{ route('seller.apply.store') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                    {{ __('Apply Now') }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>