<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Storage\PublicStorageController;
use Illuminate\Support\Facades\Route;

Route::get('storage/{path}', PublicStorageController::class)
    ->where('path', '.*')
    ->name('storage.public');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about/administration', [AboutController::class, 'administration'])->name('about.administration');
Route::get('/about/schedule', [AboutController::class, 'schedule'])->name('about.schedule');
Route::get('/about/structure', [AboutController::class, 'structure'])->name('about.structure');
Route::get('/about/mission', [AboutController::class, 'mission'])->name('about.mission');

