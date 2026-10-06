<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationStatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'from_status',
        'to_status',
        'note',
        'public_visible',
        'changed_by',
    ];

    protected $casts = [
        'public_visible' => 'boolean',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function changer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
