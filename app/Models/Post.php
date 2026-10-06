<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'excerpt',
        'body',
        'cover_image',
        'category',
        'published_at',
        'is_published',
        'author_id',
    ];

    protected $casts = [
        'title' => 'array',
        'excerpt' => 'array',
        'body' => 'array',
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
