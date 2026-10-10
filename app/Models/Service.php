<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'type',
        'title',
        'short_desc',
        'body',
        'icon',
        'cover_image',
        'sort_order',
        'is_active',
        'seo_title',
        'seo_desc',
    ];

    protected $casts = [
        'title' => 'array',
        'short_desc' => 'array',
        'body' => 'array',
        'seo_title' => 'array',
        'seo_desc' => 'array',
        'is_active' => 'boolean',
    ];

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function getIconAttribute($value): string
    {
        $map = [
            'kaaba' => 'moon-star',
            'palm-tree' => 'tree-palm',
        ];

        return $map[$value] ?? ($value ?: 'briefcase');
    }
}
