<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');

// Route untuk berita dari MediaStack
Route::get('/latest-news', [HeadlineController::class, 'index'])->name('headlines.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');

    Route::get('/news/{news:slug}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news:slug}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news:slug}', [NewsController::class, 'destroy'])->name('news.destroy');
});

Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/auth.php';
