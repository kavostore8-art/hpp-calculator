<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'quantity',
        'description',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'is_active' => 'boolean',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function hppDetail(): HasOne
    {
        return $this->hasOne(HppDetail::class);
    }

    public function priceSimulations(): HasMany
    {
        return $this->hasMany(PriceSimulation::class);
    }

    public function getHppPerPcsAttribute()
    {
        return $this->hppDetail?->hpp_per_pcs ?? 0;
    }

    public function getTotalHppAttribute()
    {
        return $this->hppDetail?->total_hpp ?? 0;
    }
}
