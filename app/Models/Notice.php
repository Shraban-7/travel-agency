<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'type',
        'related_type',
        'related_id',
        'deadline_at',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'body' => 'array',
        'deadline_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function related(): MorphTo
    {
        return $this->morphTo();
    }
}
