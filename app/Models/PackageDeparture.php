<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageDeparture extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'departure_date',
        'return_date',
        'seats_total',
        'seats_booked',
        'price',
        'booking_deadline',
        'status',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'booking_deadline' => 'date',
        'price' => 'decimal:2',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
