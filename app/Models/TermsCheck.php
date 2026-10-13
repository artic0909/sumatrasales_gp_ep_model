<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $partner_id
 * @property array $terms_and_condition
 * @property string $terms_version
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $accepted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Partner $partner
 */
class TermsCheck extends Model
{
    use HasFactory;

    protected $table = 'terms_checks';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'partner_id',
        'terms_and_condition',
        'terms_version',
        'ip_address',
        'user_agent',
        'accepted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'terms_and_condition' => 'array',
        'accepted_at'         => 'datetime',
    ];

    /**
     * Get the partner that owns the terms check.
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}
