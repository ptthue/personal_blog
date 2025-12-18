<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
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

        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', [PostController::class, 'index'])->name('posts.index');
            Route::get('/create', [PostController::class, 'create'])->name('posts.create');
            Route::post('/store', [PostController::class, 'store'])->name('posts.store');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
            Route::put('/{post}/update', [PostController::class, 'update'])->name('posts.update');
            Route::delete('/{post}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
        });
    });


});

require __DIR__.'/auth.php';
