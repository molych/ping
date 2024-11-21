<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Observers\ServiceObserver;
use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(classes: ServiceObserver::class)]
class Service extends Model
{
    /** @use HasFactory<ServiceFactory> */
    use HasFactory;
    use HasUlids;

    /** @var array<int, string> */
    protected $fillable = [
        'name',
        'url',
        'user_id',
    ];

    /**
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id'
        );
    }

    /**
     * @return hasMany<Check>
     */
    public function checks(): hasMany
    {
        return $this->hasMany(
            related: Check::class,
            foreignKey: 'service_id'
        );
    }
}
