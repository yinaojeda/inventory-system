<div class="p-4 border rounded shadow-md max-w-md mx-auto bg-gray-800 border-gray-700 text-gray-200">
    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1 text-gray-200">Category Name</label>
            <input wire:model.defer="name" id="name" type="text"
                class="w-full rounded px-3 py-2 bg-gray-500 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500" />

            @error('name')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-between items-center">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                {{ $categoryId ? 'Update' : 'Create' }} Category
            </button>

            @if ($categoryId)
                <button type="button" wire:click="resetForm" class="text-gray-400 underline hover:text-gray-200">
                    Cancel
                </button>
            @endif
        </div>
    </form>
</div>
