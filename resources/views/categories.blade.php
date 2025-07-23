<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8 space-y-6">

        {{-- Title --}}
        <div>
            <h1 class="text-4xl font-extrabold text-white flex items-center space-x-2">
                <span>📁</span>
                <span>Category Management</span>
            </h1>
            <p class="text-gray-400 mt-1">Manage your product categories below</p>
        </div>

        {{-- Card Container --}}
        <div class="bg-gray-800 rounded-2xl shadow-md p-6 border border-gray-700 space-y-8">

            {{-- Category Form --}}
            <div>
                <livewire:category-form />
            </div>
        </div>
        <div class="bg-gray-800 rounded-2xl shadow-md p-6 border border-gray-700 space-y-8">
            <hr class="border-gray-600">

            {{-- Category List --}}
            <div>
                <livewire:category-list />
            </div>
        </div>

    </div>
</x-app-layout>
