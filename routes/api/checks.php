<?php

declare(strict_types=1);

use App\Http\Controllers\Checks\DeleteController;
use App\Http\Controllers\Checks\IndexController;
use App\Http\Controllers\Checks\ShowController;
use App\Http\Controllers\Checks\StoreController;
use App\Http\Controllers\Checks\UpdateController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('/{check}', ShowController::class)->name('show');
Route::put('/{check}', UpdateController::class)->name('update');
Route::delete('/{check}', DeleteController::class)->name('delete');
