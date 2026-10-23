<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\GraphController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/database', [DatabaseController::class, 'index'])
    ->name('database.index');

Route::get('/graph', [GraphController::class, 'index'])
    ->name('graph.index');
