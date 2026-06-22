<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HppDetail extends Model
{
    use HasFactory;

    protected $table = 'hpp_details';

    protected $fillable = [
        'product_id',
        'kaos_price',
        'sablon_price',
        'dtf_price',
        'bordir_price',
        'hang_tag_price',
        'label_leher_price',
        'label_samping_price',
        'plastik_price',
        'stiker_price',
        'jahit_price',
        'qc_price',
        'packing_price',
        'operasional_price',
        'hpp_per_pcs',
        'total_hpp',
    ];

    protected $casts = [
        'kaos_price' => 'decimal:2',
        'sablon_price' => 'decimal:2',
        'dtf_price' => 'decimal:2',
        'bordir_price' => 'decimal:2',
        'hang_tag_price' => 'decimal:2',
        'label_leher_price' => 'decimal:2',
        'label_samping_price' => 'decimal:2',
        'plastik_price' => 'decimal:2',
        'stiker_price' => 'decimal:2',
        'jahit_price' => 'decimal:2',
        'qc_price' => 'decimal:2',
        'packing_price' => 'decimal:2',
        'operasional_price' => 'decimal:2',
        'hpp_per_pcs' => 'decimal:2',
        'total_hpp' => 'decimal:2',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function calculateHpp()
    {
        $this->hpp_per_pcs = $this->kaos_price +
            $this->sablon_price +
            $this->dtf_price +
            $this->bordir_price +
            $this->hang_tag_price +
            $this->label_leher_price +
            $this->label_samping_price +
            $this->plastik_price +
            $this->stiker_price +
            $this->jahit_price +
            $this->qc_price +
            $this->packing_price +
            $this->operasional_price;

        $this->total_hpp = $this->hpp_per_pcs * $this->product->quantity;
        $this->save();
    }
}
