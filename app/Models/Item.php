<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document_id',
        'description',
        'quantity',
        'unit_price',
        'vat',
        'total_ht',
        'total_tva',
        'total_ttc',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'vat' => 'decimal:2',
        'total_ht' => 'decimal:2',
        'total_tva' => 'decimal:2',
        'total_ttc' => 'decimal:2',
    ];

    /**
     * Get the document that owns the item.
     */
    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    /**
     * Calculate totals before saving
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            $item->total_ht = $item->quantity * $item->unit_price;
            $item->total_tva = $item->total_ht * ($item->vat / 100);
            $item->total_ttc = $item->total_ht + $item->total_tva;
        });
    }
}