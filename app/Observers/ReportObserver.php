<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Report;
use App\Notifications\CheckFailed;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\instance;

class ReportObserver
{
    /**
     * Handle the Report "created" event.
     */
    public function created(Report $report): void
    {
        if (! in_array($report->status, [Response::HTTP_OK, Response::HTTP_FOUND, Response::HTTP_SEE_OTHER], true)) {
            $report->check->service->user->notify(
                instance: new CheckFailed(
                    check: $report->check
                )
            );
        }
    }
}
