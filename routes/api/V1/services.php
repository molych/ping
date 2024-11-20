<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Services\DeleteController;
use App\Http\Controllers\V1\Services\IndexController;
use App\Http\Controllers\V1\Services\ShowController;
use App\Http\Controllers\V1\Services\StoreController;
use App\Http\Controllers\V1\Services\UpdateController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('/{ulid}', ShowController::class)->name('show');
Route::put('/{service}', UpdateController::class)->name('update');
Route::delete('/{service}', DeleteController::class)->name('delete');
