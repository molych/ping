<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Services;

use App\Http\Requests\V1\Services\WriteRequest;
use App\Http\Responses\V1\MessageResponse;
use App\Jobs\Services\CreateNewService;
use App\Models\Service;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;


final class StoreController
{
    public function __construct(
        private readonly Dispatcher $bus
    ) {}

    /**
     * @param WriteRequest $request
     * @return Responsable
     */
    public function __invoke(WriteRequest $request): Responsable
    {
        if (! Gate::allows('create', Service::class)) {
            throw new UnauthorizedException(
                message: __('services.v1.create.failure'),
                code: Response::HTTP_FORBIDDEN,
            );
        }

        $this->bus->dispatch(
            command: new CreateNewService(
              payload: $request->payload()
            ),
        );

        return new MessageResponse(
            message:  __('services.v1.create.success'),
            status: Response::HTTP_ACCEPTED,
        );
    }
}
