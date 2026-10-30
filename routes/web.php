<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/database', [DatabaseController::class, 'index'])->name('database.index');
Route::get('/graph', [GraphController::class, 'index'])->name('graph.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::get('user', function () {
        return view('user');
    })->name('user');

    Route::get('admin', [AdminController::class, 'adminPage']);
});

require __DIR__.'/settings.php';

Route::get('exercise1', function () {
    return view('view1');
});

Route::get('introduction', function () {
    return view('introduction');
});