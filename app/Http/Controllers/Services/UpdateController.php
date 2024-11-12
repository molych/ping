<?php

declare(strict_types=1);

namespace App\Http\Controllers\Services;

use App\Http\Requests\V1\Services\WriteRequest;
use App\Http\Responses\V1\MessageResponse;
use App\Jobs\Services\UpdateService;
use App\Models\Service;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

final class UpdateController
{
    public function __construct(
        private readonly Dispatcher $bus
    ) {}

    /**
     * @param WriteRequest $request
     * @param Service $service
     * @return Responsable
     */
    public function __invoke(WriteRequest $request, Service $service): Responsable
    {
        if (! Gate::allows('update', $service)) {
            throw new UnauthorizedException(
                message: 'You are not able to update this service that you not owm',
                code: Response::HTTP_FORBIDDEN,
            );
        }

        $this->bus->dispatch(
            command: new UpdateService(
                payload: $request->payload(),
                service: $service
            ),
        );

        return new MessageResponse(
            message: 'Your service will be update in the background',
            status: Response::HTTP_ACCEPTED,
        );
    }
}
