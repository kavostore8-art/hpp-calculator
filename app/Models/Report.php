<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'report_date',
        'total_products',
        'total_production_qty',
        'total_hpp',
        'total_sales',
        'total_profit',
        'created_by',
    ];

    protected $casts = [
        'report_date' => 'datetime',
        'total_products' => 'integer',
        'total_production_qty' => 'integer',
        'total_hpp' => 'decimal:2',
        'total_sales' => 'decimal:2',
        'total_profit' => 'decimal:2',
    ];

    public const TYPES = [
        'production' => 'Laporan Produksi',
        'hpp' => 'Laporan HPP',
        'profit' => 'Laporan Profit',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
