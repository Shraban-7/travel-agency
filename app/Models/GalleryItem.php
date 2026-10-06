<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'file',
        'url',
        'caption',
        'album',
        'sort_order',
    ];

    protected $casts = [
        'caption' => 'array',
    ];
}
