<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'date_sale',
        'client_id',
        'price_unit',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(ItemSale::class);
    }

    // protected static function booted()
    // {
    //     parent::boot();

    //     static::creating(function (Sale $sale) {
    //         dd($sale->itemSale);
    //     });
        
    //     static::updating(function (Sale $sale) {

    //     });
    // }
}
