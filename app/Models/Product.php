<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'category',
        'description',
        'price',
        'type',
        'product_api_url',
    ];

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
