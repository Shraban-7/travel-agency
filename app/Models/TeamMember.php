<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'photo',
        'phone',
        'sort_order',
    ];

    protected $casts = [
        'name' => 'array',
        'role' => 'array',
    ];
}
