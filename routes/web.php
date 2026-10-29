<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotebookController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/database', [DatabaseController::class, 'index'])
    ->name('database.index');

Route::get('/graph', [GraphController::class, 'index'])
    ->name('graph.index');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

Route::resource('notebooks', NotebookController::class)->except(['show']);
