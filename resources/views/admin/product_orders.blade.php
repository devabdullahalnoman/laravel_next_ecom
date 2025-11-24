<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Orders for {{ $product->title }}</h2>
    </x-slot>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold mb-4">Order History</h3>
        <table class="w-full border-collapse mb-5">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Buyer</th>
                    <th class="border px-4 py-2">Quantity</th>
                    <th class="border px-4 py-2">Total Price</th>
                    <th class="border px-4 py-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td class="border px-4 py-2">{{ $order->buyer->name }}</td>
                    <td class="border px-4 py-2">{{ $order->quantity }}</td>
                    <td class="border px-4 py-2">{{ $order->total_price }}</td>
                    <td class="border px-4 py-2">{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</x-app-layout>