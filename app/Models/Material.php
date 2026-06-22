<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price',
        'unit',
        'description',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public const CATEGORIES = [
        'kaos_polos' => 'Kaos Polos',
        'sablon' => 'Sablon',
        'dtf' => 'DTF',
        'bordir' => 'Bordir',
        'hang_tag' => 'Hang Tag',
        'label_leher' => 'Label Leher',
        'label_samping' => 'Label Samping',
        'plastik_packing' => 'Plastik Packing',
        'stiker' => 'Stiker',
        'jahit' => 'Ongkos Jahit',
        'qc' => 'Ongkos QC',
        'packing' => 'Ongkos Packing',
        'operasional' => 'Biaya Operasional',
    ];
}
