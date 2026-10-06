<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'number',
        'issuer',
        'image',
        'sort_order',
    ];

    protected $casts = [
        'title' => 'array',
    ];
}
