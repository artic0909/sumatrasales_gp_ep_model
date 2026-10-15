<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $inquiry_type
 * @property string $message
 * @property string $status
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class ContactInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'inquiry_type',
        'message',
        'status',
        'ip_address',
        'user_agent',
    ];

    /**
     * Scope to retrieve unread inquiries.
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }
}
