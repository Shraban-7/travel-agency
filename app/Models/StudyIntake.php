<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyIntake extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'intake_name',
        'start_date',
        'application_deadline',
        'seats',
    ];

    protected $casts = [
        'start_date' => 'date',
        'application_deadline' => 'date',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'program_id');
    }
}
