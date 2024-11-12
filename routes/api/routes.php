<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->as('v1:')->group(static function (): void {
    Route::middleware([ 'throttle:api'])->group(static function (): void {
        Route::get('/user', static fn(Request $request) => $request->user())->name('user');

        Route::prefix('/services')->as('services:')->group(static function (): void {
            require base_path('routes/api/services.php');
        });

        Route::prefix('/credentials')->as('credentials:')->group(static function (): void {
            require base_path('routes/api/credentials.php');
        });

        Route::prefix('/checks')->as('checks:')->group(static function (): void {
            require base_path('routes/api/checks.php');
        });
    });
});
