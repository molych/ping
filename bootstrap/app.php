<?php

declare(strict_types=1);

use App\Jobs\ErrorFactory;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Treblle\SecurityHeaders\Http\Middleware\CertificateTransparencyPolicy;
use Treblle\SecurityHeaders\Http\Middleware\ContentTypeOptions;
use Treblle\SecurityHeaders\Http\Middleware\PermissionsPolicy;
use Treblle\SecurityHeaders\Http\Middleware\RemoveHeaders;
use Treblle\SecurityHeaders\Http\Middleware\SetReferrerPolicy;
use Treblle\SecurityHeaders\Http\Middleware\StrictTransportSecurity;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web/routes.php',
        api: __DIR__ . '/../routes/api/routes.php',
        commands: __DIR__ . '/../routes/console/console.php',
        health: '/up',
        apiPrefix: ''
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            RemoveHeaders::class,
            SetReferrerPolicy::class,
            StrictTransportSecurity::class,
            PermissionsPolicy::class,
            ContentTypeOptions::class,
            CertificateTransparencyPolicy::class,
        ]);

        $middleware->alias([
            'verified' => App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(fn(UnprocessableEntityHttpException $exception) => new JsonResponse(
            data:  $exception->getMessage(),
            status: 422,
        ));
        $exceptions->render(fn(Throwable $exception, Request $request) => ErrorFactory::create(
            exception: $exception,
            request: $request
        ));
    })->create();
