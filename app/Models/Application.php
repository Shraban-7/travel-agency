<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tracking_code',
        'client_id',
        'service_type',
        'applicable_type',
        'applicable_id',
        'country_id',
        'status',
        'status_label',
        'assigned_to',
        'submitted_at',
        'total_fee',
        'paid_amount',
        'due_amount',
        'remarks_internal',
        'public_note',
        'closed_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'closed_at' => 'datetime',
        'total_fee' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function applicable(): MorphTo
    {
        return $this->morphTo();
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(ApplicationStatusLog::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ApplicationDocument::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(PaymentSchedule::class);
    }

    public function extra(): HasOne
    {
        return $this->hasOne(ApplicationExtra::class);
    }
}
