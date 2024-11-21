<?php

namespace App\Jobs;

use App\Models\Check;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class SendPing implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public readonly Check $check)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $request = Http::baseUrl(
            url: $this->check->service->url,
        );

        if ($this->check->credentials) {

        }

        if ($this->check->parameters) {
            $request->withQueryParameters(
                parameters: $this->check->parameters,
            );
        }

        if ($this->check->headers) {
            $request->withHeaders(
                headers: $this->check->headers,

            );
        }

        $response = $request->send(
            method: $this->check->method,
            url: $this->check->path,
            options: [
                'json' => $this->check->json
            ],
        );
        dd ($response->transferStats);
    }
}
