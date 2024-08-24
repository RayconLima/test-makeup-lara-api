<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'amount',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        parent::boot();

        static::creating(function (ItemSale $itemSale) {
            $itemSale->amount = $itemSale->quantity * $itemSale->unit_price;
        });
        
        static::updating(function (ItemSale $itemSale) {
            $itemSale->amount = $itemSale->quantity * $itemSale->unit_price;
        });
    }
}
