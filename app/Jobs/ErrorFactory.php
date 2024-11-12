<?php

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use JustSteveKing\Tools\Http\Enums\Status;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Treblle\ApiResponses\Data\ApiError;
use Treblle\ApiResponses\Responses\ErrorResponse;

final class ErrorFactory
{
    public static function create(\Throwable $exception, Request $request): ErrorResponse
    {
        return match ($exception::class) {
            ModelNotFoundException::class,
            NotFoundHttpException::class => new ErrorResponse(
                data: new ApiError(
                    title: 'Resource Not Found',
                    detail: $exception->getMessage(),
                    instance: $request->fullUrl(),
                    code: 'HTTP-404',
                    link: 'https://docs.treblle.com/errors/404',
                ),
                status: Status::NOT_FOUND,
            ),
            MethodNotAllowedException::class,
            MethodNotAllowedHttpException::class=> new ErrorResponse(
                data: new ApiError(
                    title: 'Method not allowed',
                    detail: $exception->getMessage(),
                    instance: $request->fullUrl(),
                    code: 'HTTP-405',
                    link: 'https://docs.treblle.com/errors/405',
                ),
                status: Status::METHOD_NOT_ALLOWED,
            ),
            default => new ErrorResponse(
                data: new ApiError(
                    title: 'Server Error',
                    detail: $exception->getMessage(),
                    instance: $request->fullUrl(),
                    code: 'HTTP-500',
                    link: 'https://docs.treblle.com/errors/500',
                ),
                status: Status::INTERNAL_SERVER_ERROR,
            ),
        };
    }
}
