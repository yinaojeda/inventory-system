<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">
        {{ $categoryId ? 'Edit Category' : 'New Category' }}
    </h2>

    @if (session('status') === 'category-saved')
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm">
            Saved successfully.
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
            <input id="name" type="text" wire:model.defer="name" autocomplete="off"
                class="mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" />
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ $categoryId ? 'Update' : 'Create' }}
            </x-primary-button>

            @if ($categoryId)
                <button type="button" wire:click="resetForm"
                    class="text-sm underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200">
                    Cancel
                </button>
            @endif
        </div>
    </form>
</div>
