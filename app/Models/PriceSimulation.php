<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceSimulation extends Model
{
    use HasFactory;

    protected $table = 'price_simulations';

    protected $fillable = [
        'product_id',
        'margin_percent',
        'hpp_per_pcs',
        'price_per_pcs',
        'profit_per_pcs',
        'total_profit',
        'created_by',
    ];

    protected $casts = [
        'margin_percent' => 'decimal:2',
        'hpp_per_pcs' => 'decimal:2',
        'price_per_pcs' => 'decimal:2',
        'profit_per_pcs' => 'decimal:2',
        'total_profit' => 'decimal:2',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function calculatePrice()
    {
        $this->hpp_per_pcs = $this->product->hppDetail->hpp_per_pcs;
        $this->price_per_pcs = $this->hpp_per_pcs + ($this->hpp_per_pcs * $this->margin_percent / 100);
        $this->profit_per_pcs = $this->price_per_pcs - $this->hpp_per_pcs;
        $this->total_profit = $this->profit_per_pcs * $this->product->quantity;
        $this->save();
    }
}
