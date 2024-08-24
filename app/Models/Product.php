<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'type_id',
        'category_id',
        'description',
        'price',
        'count_in_stock',
        'product_api_url',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function itemSales()
    {
        return $this->hasMany(ItemSale::class);
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $lastProduct = static::query()->orderBy('id', 'desc')->first();
            if ($lastProduct) {
                $product->sku = 'PROD-' . str_pad($lastProduct->getKey() + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $product->sku = 'PROD-0001';
            }
        });
    }
}
