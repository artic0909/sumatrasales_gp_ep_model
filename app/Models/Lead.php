<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'fb_leadgen_id',
        'page_id',
        'form_id',
        'form_name',
        'ad_id',
        'ad_name',
        'adset_id',
        'adset_name',
        'campaign_id',
        'campaign_name',
        'name',
        'email',
        'phone',
        'status',
        'synced_to_fb',
        'synced_at',
        'notes',
        'raw_data',
    ];

    protected $casts = [
        'synced_to_fb' => 'boolean',
        'synced_at' => 'datetime',
        'raw_data' => 'array',
    ];

    /**
     * Scope a query to only include new leads.
     */
    public function scopeNewLeads($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope a query to only include good/qualified leads.
     */
    public function scopeGoodLeads($query)
    {
        return $query->where('status', 'good_lead');
    }

    /**
     * Scope a query to only include bad leads.
     */
    public function scopeBadLeads($query)
    {
        return $query->where('status', 'bad_lead');
    }

    /**
     * Scope a query to only include leads synced to Facebook CAPI.
     */
    public function scopeSynced($query)
    {
        return $query->where('synced_to_fb', true);
    }

    /**
     * Scope a query to only include leads not yet synced to Facebook CAPI.
     */
    public function scopeUnsynced($query)
    {
        return $query->where('synced_to_fb', false);
    }

    /**
     * Get clean normalized phone for display or processing.
     */
    public function getCleanPhoneAttribute(): ?string
    {
        if (!$this->phone) {
            return null;
        }
        return preg_replace('/[^0-9]/', '', $this->phone);
    }
}

