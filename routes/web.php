<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
        });
    });


});

require __DIR__.'/auth.php';
