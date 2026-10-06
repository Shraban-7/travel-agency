<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'flag_code',
        'region',
        'intro',
        'visa_info',
        'life_info',
        'cover_image',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'name' => 'array',
        'intro' => 'array',
        'visa_info' => 'array',
        'life_info' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function universities(): HasMany
    {
        return $this->hasMany(University::class);
    }

    public function jobDemands(): HasMany
    {
        return $this->hasMany(JobDemand::class);
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'package_country');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'interested_country_id');
    }
}
