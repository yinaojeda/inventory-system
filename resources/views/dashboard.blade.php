<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 px-6 max-w-6xl mx-auto space-y-10">
        <div class="text-center text-gray-200 mt-16">
            <h1 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="text-indigo-300 text-lg">Here's your inventory overview.</p>
        </div>

        <div
            class="bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300 w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <x-dashboard-card title="Total Products" :count="$productCount" icon="cube" />
                <x-dashboard-card title="Categories" :count="$categoryCount" icon="folder" />
                <x-dashboard-card title="Low Stock" :count="$lowStockCount" icon="exclamation-circle" />
                <x-dashboard-card title="Inventory Value" :count="'$' . number_format($inventoryValue, 2)" icon="currency-dollar" />
            </div>
        </div>

        <div
            class="bg-indigo-600 rounded-2xl shadow-lg p-6 text-gray-200 hover:scale-105 transition-transform duration-300 w-full">
            <h3 class="text-xl font-semibold mb-4">Recently Added Products</h3>
            <ul class="list-disc list-inside space-y-2">
                @foreach ($recentProducts as $product)
                    <li class="hover:text-indigo-300 transition">
                        {{ $product->name }} - <span
                            class="text-gray-400 text-sm">{{ $product->created_at->diffForHumans() }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 px-6 max-w-6xl mx-auto space-y-10">
        <!-- Your existing dashboard cards and lists here -->

        <div class="mx-auto my-10" style="width: 350px; height: 300px; position: relative;">
            <h3 class="text-xl font-semibold mb-4 text-gray-200">Products per Category</h3>
            <canvas id="productsCategoryChart" style="max-width: 100%; max-height: 100%;"></canvas>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('productsCategoryChart').getContext('2d');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: @json($categories),
                    datasets: [{
                        data: @json($productCounts),
                        backgroundColor: [
                            '#6366f1', '#ef4444', '#f59e0b', '#10b981',
                            '#3b82f6', '#8b5cf6', '#ec4899', '#14b8a6',
                        ],
                        hoverOffset: 30
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#e5e7eb'
                            }
                        }
                    }
                }
            });
        });
    </script>
    <div class="mx-auto my-10" style="width: 400px; height: 300px; position: relative;">
        <h3 class="text-xl font-semibold mb-4 text-gray-200">Products by Price (Cheapest to Expensive)</h3>
        <canvas id="productsPriceChart" style="max-width: 100%; max-height: 100%;"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctxPrice = document.getElementById('productsPriceChart').getContext('2d');

            new Chart(ctxPrice, {
                type: 'bar', // bar chart is good for prices comparison
                data: {
                    labels: @json($productNames),
                    datasets: [{
                        label: 'Price ($)',
                        data: @json($productPrices),
                        backgroundColor: '#4f46e5', // indigo-600
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#e5e7eb' // light text for dark background
                            },
                            grid: {
                                color: 'rgba(229, 231, 235, 0.2)'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#e5e7eb'
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#e5e7eb'
                            }
                        }
                    }
                }
            });
        });
    </script>




</x-app-layout>
