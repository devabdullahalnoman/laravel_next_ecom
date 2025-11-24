<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Order Confirmation') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <p><strong>Product:</strong> {{ $order->product->title }}</p>
            <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
            <p><strong>Shipping to:</strong> {{ $order->buyer_address }}</p>
            <p><strong>Contact:</strong> {{ $order->buyer_phone }}</p>
        </div>
    </div>
</x-app-layout>