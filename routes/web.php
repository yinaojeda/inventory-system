<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/categories', \App\Http\Livewire\CategoryList::class)->name('categories');
    Route::get('/products', \App\Http\Livewire\ProductsList::class)->name('products');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/categories', function () {
        return view('categories');
    })->name('categories');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/products', function () {
        return view('products');
    })->name('products');
});



require __DIR__.'/auth.php';
