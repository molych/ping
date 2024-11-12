<?php

namespace App\Jobs\Services;

use App\Http\Payloads\V1\CreateService;
use App\Models\Service;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Queue\Queueable;

class DeleteService implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly Service $service
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: fn () => $this->service->delete(),
            attempts: 3
        );
    }
}
