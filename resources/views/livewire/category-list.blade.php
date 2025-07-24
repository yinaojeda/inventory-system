<div class="max-w-4xl mx-auto mt-8 text-gray-200">
    
    @if ($categories->count())
        <table class="w-full border border-gray-600 rounded">
            <thead class="bg-gray-700 text-gray-200">
                <tr>
                    <th class="border border-gray-600 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-600 px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="hover:bg-gray-700">
                        <td class="border border-gray-600 px-4 py-2">{{ $category->name }}</td>
                        <td class="border border-gray-600 px-4 py-2 text-center space-x-2">
                            <button wire:click="editCategory({{ $category->id }})"
                                class="text-blue-400 hover:underline">✏️ Edit</button>
                            <button wire:click="confirmDelete({{ $category->id }})"
                                class="text-red-500 hover:underline">🗑️ Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-400 italic">No categories found.</p>
    @endif
</div>
