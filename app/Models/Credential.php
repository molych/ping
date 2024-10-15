<?php

namespace App\Models;

use Database\Factories\CredentialFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Credential extends Model
{
    /** @use HasFactory<CredentialFactory> */
    use HasFactory;
    use HasUlids;

    /** @var string<int, string> */
    protected $fillable = [
        'name',
        'type',
        'value',
        'user_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => 'array',
            'value' => 'encrypted',
        ];
    }

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
