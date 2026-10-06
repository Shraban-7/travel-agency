<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public function jobDemands(): HasMany
    {
        return $this->hasMany(JobDemand::class, 'category_id');
    }
}
