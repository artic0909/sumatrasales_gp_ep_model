<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadFollowup extends Model
{
    use HasFactory;

    protected $table = 'lead_followups';

    protected $fillable = [
        'lead_id',
        'type',
        'notes',
        'status',
        'followup_date',
        'next_followup_date',
        'user_id',
        'created_by_name',
    ];

    protected $casts = [
        'followup_date' => 'datetime',
        'next_followup_date' => 'datetime',
    ];

    /**
     * Parent Lead relation.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    /**
     * Admin/User who performed the follow-up.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Human-readable label for the follow-up type.
     */
    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'calling'  => 'Phone Call',
            'whatsapp' => 'WhatsApp',
            'both'     => 'Call & WhatsApp',
            default    => ucfirst($this->type ?? 'Interaction'),
        };
    }

    /**
     * Icon representation for the type.
     */
    public function getTypeIconAttribute(): string
    {
        return match($this->type) {
            'calling'  => '📞',
            'whatsapp' => '💬',
            'both'     => '📞💬',
            default    => '📋',
        };
    }
}
