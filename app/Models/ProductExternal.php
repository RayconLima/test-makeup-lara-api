<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductExternal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'category',
        'description',
        'price',
        'price_sign',
        'product_type',
        'product_api_url',
    ];

    public $timestamps = false;
}
