<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Checks\DeleteController;
use App\Http\Controllers\V1\Checks\IndexController;
use App\Http\Controllers\V1\Checks\ShowController;
use App\Http\Controllers\V1\Checks\StoreController;
use App\Http\Controllers\V1\Checks\UpdateController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('/{check}', ShowController::class)->name('show');
Route::put('/{check}', UpdateController::class)->name('update');
Route::delete('/{check}', DeleteController::class)->name('delete');
