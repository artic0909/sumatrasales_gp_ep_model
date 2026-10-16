<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $registration_type
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string|null $state
 * @property string|null $district
 * @property string|null $city
 * @property string|null $address
 * @property string $aadhaar_number
 * @property string|null $aadhaar_front_image
 * @property string|null $aadhaar_back_image
 * @property string $pancard_number
 * @property string|null $pancard_front_image
 * @property string|null $pancard_back_image
 * @property string $bank_account_number
 * @property string $bank_name
 * @property string $ifsc_code
 * @property string|null $self_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Partner extends Model
{
    use HasFactory;

    public const REGISTRATION_TYPE_EP = 'EP';
    public const REGISTRATION_TYPE_GP = 'GP';

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'registration_type',
        'status',
        'name',
        'phone',
        'email',
        'state',
        'district',
        'city',
        'address',
        'aadhaar_number',
        'aadhaar_front_image',
        'aadhaar_back_image',
        'pancard_number',
        'pancard_front_image',
        'pancard_back_image',
        'bank_account_number',
        'bank_name',
        'ifsc_code',
        'self_image',
        'interests',
        'application_code',
        'approved_code',
        'approved_at',
        'rejection_reason',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'interests' => 'array',
        'approved_at' => 'datetime',
    ];

    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Get the terms check record associated with the partner.
     */
    public function termsCheck(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TermsCheck::class);
    }
}
