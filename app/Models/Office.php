<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'map_embed',
        'is_head_office',
    ];

    protected $casts = [
        'name' => 'array',
        'address' => 'array',
        'is_head_office' => 'boolean',
    ];
}
