<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeCotroller;

Route::get('/', [HomeCotroller::class, 'home'])->name('profile.edit');
Route::middleware('auth')->group(function () {
    Route::prefix('catalog')->group(function () {
        Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
        Route::get('/show/{id}', [CatalogController::class, 'show'])->name('catalog.show');
        Route::get('/create', [CatalogController::class, 'create'])->name('catalog.create');
        Route::get('/edit/{id}', [CatalogController::class, 'edit'])->name('catalog.edit');
        Route::post('/store', [CatalogController::class, 'store'])->name('catalog.store');
        Route::put('/update/{id}', [CatalogController::class, 'update'])->name('catalog.update');
        Route::delete('/delete/{id}', [CatalogController::class, 'destroy'])->name('catalog.destroy');
        Route::put("/rent/{id}", [CatalogController::class, 'rent'])->name('catalog.rent');
        Route::put("/return/{id}", [CatalogController::class, 'return'])->name('catalog.return');
    });
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
