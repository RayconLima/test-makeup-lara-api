<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'total',
        'date_sale',
        'price_unit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(ItemSale::class);
    }

    protected static function booted()
    {
        parent::boot();

        static::creating(function (Sale $sale) {
            $sale->user_id  =   Auth::user()->id;
        });
        
        static::updating(function (Sale $sale) {
            $sale->user_id  =   Auth::user()->id;            
        });
    }
}
