<div class="max-w-md mx-auto mt-6 text-gray-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-100">📁 Categories</h2>

    @if ($categories->count())
        <ul class="space-y-3">
            @foreach ($categories as $category)
                <li
                    class="flex justify-between items-center bg-gray-800 border border-gray-700 rounded-lg px-5 py-3 shadow hover:shadow-md transition">
                    <span class="text-lg font-medium">{{ $category->name }}</span>
                    <div class="flex space-x-3">
                        <button wire:click="editCategory({{ $category->id }})"
                            class="text-blue-400 hover:text-blue-600 transition duration-150 ease-in-out" title="Edit">
                            ✏️ Edit
                        </button>
                        <button wire:click="deleteCategory({{ $category->id }})"
                            onclick="confirm('Delete this category?') || event.stopImmediatePropagation()"
                            class="text-red-500 hover:text-red-700 transition duration-150 ease-in-out" title="Delete">
                            🗑️ Delete
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-400 italic text-sm mt-4">No categories found.</p>
    @endif
</div>
