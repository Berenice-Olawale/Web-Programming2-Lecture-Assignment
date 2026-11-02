<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotebookController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PriceCalculatorController;

Route::get('/price-calculator', [PriceCalculatorController::class, 'showForm'])->name('price.form');
Route::post('/price-calculator', [PriceCalculatorController::class, 'calculate'])->name('price.calculate');

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

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
});

Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::resource('notebooks', NotebookController::class)->except(['show']);
});