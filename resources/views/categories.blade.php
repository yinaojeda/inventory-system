
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category Management') }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <livewire:category-form />
        <livewire:category-list />
    </div>
</x-app-layout>

