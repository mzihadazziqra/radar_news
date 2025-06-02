<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HeadlineController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::get('/news', [NewsController::class, 'index'])->name('api.news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'index'])->name('api.news.show');

Route::get('/headlines', [HeadlineController::class, 'index'])->name('api.headlines.index');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('api.user');
});
