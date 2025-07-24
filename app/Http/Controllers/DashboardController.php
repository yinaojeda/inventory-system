<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use DB;

class DashboardController extends Controller
{
    public function index()
    {

        $productCount = Product::count();
        $categoryCount = Category::count();
        $lowStockCount = Product::where('quantity', '<', 5)->count();

        $recentProducts = Product::latest()->take(5)->get();

        $inventoryValue = Product::sum(DB::raw('price * quantity'));

        $categories = Category::pluck('name');
        $productCounts = Category::withCount('products')->pluck('products_count');
        $productsByPrice = Product::orderBy('price')->limit(10)->get(); // Top 10 cheapest

        $productNames = $productsByPrice->pluck('name');
        $productPrices = $productsByPrice->pluck('price');



        return view('dashboard', compact(
            'productCount',
            'categoryCount',
            'lowStockCount',
            'recentProducts',
            'inventoryValue',
            'categories',
            'productCounts',
            'productsByPrice',
            'productPrices',
            'productNames'
        ));
    }
}
