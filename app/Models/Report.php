<?php

namespace App\Models;

use App\Observers\ReportObserver;
use Database\Factories\ReportFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(ReportObserver::class)]
class Report extends Model
{
    /** @use HasFactory<ReportFactory> */
    use HasFactory;
    use HasUlids;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'content_type',
        'status',
        'header_size',
        'request_size',
        'redirect_count',
        'http_version',
        'appconnect-time',
        'connect_time',
        'namelookur_time',
        'pretranster_time',
        'redirect_time',
        'stanttranster_time',
        'total_time',
        'check_id',
        'started_at',
        'finished_at'
    ];


    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'integer',
            'header _size' => 'integer',
            'request_size' => 'integer',
            'redirect_count' => 'integer',
            'http_version' => 'integer',
            'appconnect_time' => 'integer',
            'connect_time' => 'integer',
            'nameleokur-time' => 'integer',
            'pretransfer-time' => 'integer',
            'redirect_time' => 'integer',
            'stanttransfer-time' => 'integer',
            'total_time' => 'integer',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Check>
     */
    public function check(): BelongsTo
    {
        return $this->belongsTo(
            related: Check::class,
            foreignKey: 'check_id'
        );
    }
}
