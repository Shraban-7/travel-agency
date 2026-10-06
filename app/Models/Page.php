<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'body',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'body' => 'array',
        'is_active' => 'boolean',
    ];
}
