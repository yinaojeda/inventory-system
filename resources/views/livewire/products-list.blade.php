<div class="max-w-4xl mx-auto mt-8 text-gray-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-100">Products</h2>

    @if ($products->count())
        <table class="w-full border border-gray-600 rounded">
            <thead class="bg-gray-700 text-gray-200">
                <tr>
                    <th class="border border-gray-600 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-600 px-4 py-2 text-left">Category</th>
                    <th class="border border-gray-600 px-4 py-2 text-right">Price</th>
                    <th class="border border-gray-600 px-4 py-2 text-right">Quantity</th>
                    <th class="border border-gray-600 px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-700">
                        <td class="border border-gray-600 px-4 py-2">{{ $product->name }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $product->category?->name ?? '-' }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-right">${{ number_format($product->price, 2) }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-right">{{ $product->quantity }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-center space-x-2">
                            <button wire:click="editProduct({{ $product->id }})" class="text-blue-400 hover:underline">✏️ Edit</button>
                            <button wire:click="confirmDelete({{ $product->id }})" class="text-red-500 hover:underline">🗑️ Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-400 italic">No products found.</p>
    @endif
</div>
