<?php

declare(strict_types=1);

namespace App\Http\Controllers\Services;

use App\Http\Resources\V1\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

final class IndexController
{
    public function __invoke(): JsonResponse
    {
        $services= QueryBuilder::for(
            subject: Service::class,
        )->allowedFilters(
            filters: [
                'url'
            ]
        )->allowedIncludes(
            includes:[
                'checks'
            ]
        )->getEloquentBuilder()->simplePaginate(
            perPage: config('app.paginator.limit')
        );

        return new JsonResponse(
            data: ServiceResource::collection(
                resource: $services
            )
        );
    }
}
