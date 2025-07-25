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

        <!-- Summary Cards -->
        <div
            class="bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <x-dashboard-card title="Total Products" :count="$productCount" icon="cube" />
                <x-dashboard-card title="Categories" :count="$categoryCount" icon="folder" />
                <x-dashboard-card title="Low Stock" :count="$lowStockCount" icon="exclamation-circle" />
                <x-dashboard-card title="Inventory Value" :count="'$' . number_format($inventoryValue, 2)" icon="currency-dollar" />
            </div>
        </div>

        <!-- Recently Added Products (Half Width) -->
        <div class="w-full lg:w-1/2">
            <div
                class="bg-indigo-600 rounded-2xl shadow-lg p-6 text-gray-200 hover:scale-105 transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-4">Recently Added Products</h3>
                <ul class="list-disc list-inside space-y-2">
                    @foreach ($recentProducts as $product)
                        <li class="hover:text-indigo-300 transition">
                            {{ $product->name }} -
                            <span class="text-gray-400 text-sm">{{ $product->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Charts Side by Side -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Products per Category -->
            <div class="bg-gray-800 p-6 rounded-2xl shadow-lg text-white">
                <h3 class="text-xl font-semibold mb-4">Products per Category</h3>
                <div class="h-80">
                    <canvas id="productsCategoryChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <!-- Products by Price -->
            <div class="bg-gray-800 p-6 rounded-2xl shadow-lg text-white">
                <h3 class="text-xl font-semibold mb-4">Products by Price (Cheapest to Expensive)</h3>
                <div class="h-80">
                    <canvas id="productsPriceChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pie Chart
            const ctx = document.getElementById('productsCategoryChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: @json($categories),
                    datasets: [{
                        data: @json($productCounts),
                        backgroundColor: ['#6366f1', '#ef4444', '#f59e0b', '#10b981', '#3b82f6',
                            '#8b5cf6', '#ec4899', '#14b8a6'
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

            // Bar Chart
            const ctxPrice = document.getElementById('productsPriceChart').getContext('2d');
            new Chart(ctxPrice, {
                type: 'bar',
                data: {
                    labels: @json($productNames),
                    datasets: [{
                        label: 'Price ($)',
                        data: @json($productPrices),
                        backgroundColor: '#4f46e5',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#e5e7eb'
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
