<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Authenticatable
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'full_name',
        'full_name_bn',
        'phone',
        'password',
        'email',
        'gender',
        'dob',
        'nid_no',
        'nid_no_hash',
        'passport_no',
        'passport_no_hash',
        'passport_expiry',
        'address',
        'district',
        'emergency_contact_name',
        'emergency_contact_phone',
        'lead_id',
        'notes',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'nid_no',
        'passport_no',
        'nid_no_hash',
        'passport_no_hash',
    ];

    protected $casts = [
        'dob' => 'date',
        'passport_expiry' => 'date',
        'nid_no' => 'encrypted',
        'passport_no' => 'encrypted',
        'password' => 'hashed',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty()->dontSubmitEmptyLogs()
            ->logExcept(['password', 'remember_token', 'nid_no', 'passport_no', 'nid_no_hash', 'passport_no_hash']);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
