<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Lead extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'whatsapp',
        'service_type',
        'interested_country_id',
        'interested_item_type',
        'interested_item_id',
        'message',
        'source',
        'utm',
        'status',
        'assigned_to',
        'follow_up_at',
        'lost_reason',
        'ip',
    ];

    protected $casts = [
        'utm' => 'array',
        'follow_up_at' => 'datetime',
    ];

    public function interestedCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'interested_country_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty()->dontSubmitEmptyLogs();
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function interestedItem(): MorphTo
    {
        return $this->morphTo();
    }

    public function notes(): HasMany
    {
        return $this->hasMany(LeadNote::class, 'lead_id');
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'lead_id');
    }
}
