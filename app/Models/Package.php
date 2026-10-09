<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Package extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity, SoftDeletes;

    protected $fillable = [
        'service_id',
        'slug',
        'type',
        'title',
        'summary',
        'description',
        'itinerary',
        'inclusions',
        'exclusions',
        'duration_days',
        'base_price',
        'currency',
        'price_note',
        'hotel_info',
        'airline',
        'cover_image',
        'is_featured',
        'is_published',
        'sort_order',
        'seo_title',
        'seo_desc',
    ];

    protected $casts = [
        'title' => 'array',
        'summary' => 'array',
        'description' => 'array',
        'itinerary' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'base_price' => 'decimal:2',
        'price_note' => 'array',
        'hotel_info' => 'array',
        'seo_title' => 'array',
        'seo_desc' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty()->dontSubmitEmptyLogs();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->nonQueued();
        $this->addMediaConversion('card')->width(800)->nonQueued();
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'package_country');
    }

    public function departures(): HasMany
    {
        return $this->hasMany(PackageDeparture::class, 'package_id');
    }

    public function legacyMedia(): HasMany
    {
        return $this->hasMany(PackageMedia::class, 'package_id');
    }
}
