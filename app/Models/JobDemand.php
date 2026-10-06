<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobDemand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'country_id',
        'category_id',
        'slug',
        'title',
        'company_name',
        'positions',
        'salary_min',
        'salary_max',
        'salary_currency',
        'contract_months',
        'benefits',
        'requirements',
        'required_documents',
        'estimated_total_cost',
        'service_charge_note',
        'demand_ref',
        'application_deadline',
        'status',
        'is_published',
        'cover_image',
    ];

    protected $casts = [
        'title' => 'array',
        'benefits' => 'array',
        'requirements' => 'array',
        'required_documents' => 'array',
        'service_charge_note' => 'array',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'estimated_total_cost' => 'decimal:2',
        'application_deadline' => 'date',
        'is_published' => 'boolean',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }
}
