<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudyProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'name',
        'level',
        'field',
        'duration',
        'tuition_fee',
        'currency',
        'language',
        'requirements',
        'scholarship_info',
        'is_active',
    ];

    protected $casts = [
        'name' => 'array',
        'requirements' => 'array',
        'scholarship_info' => 'array',
        'tuition_fee' => 'decimal:2',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function intakes(): HasMany
    {
        return $this->hasMany(StudyIntake::class, 'program_id');
    }
}
