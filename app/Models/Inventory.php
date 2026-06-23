<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity_in',
        'quantity_out',
        'balance',
        'notes',
        'type',
    ];

    protected $casts = [
        'quantity_in' => 'integer',
        'quantity_out' => 'integer',
        'balance' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
