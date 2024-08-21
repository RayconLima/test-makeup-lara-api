<?php

namespace App\Services\External;

use App\Models\ProductExternal;

class MakeupApiService
{
    public function getProducts()
    {
        $api = config('app.EXTERNAL_API').'/products.json';
        $productsData = json_decode(file_get_contents($api), true);

        $products = [];
        foreach ($productsData as $productData) {
            $product = new ProductExternal();
            $product->name = $productData['name'];
            $product->brand = $productData['brand'];
            $product->category = $productData['category'];
            $product->description = $productData['description'];
            $product->price = $productData['price'];
            $product->price_sign = $productData['price_sign'];
            $product->product_type = $productData['product_type'];
            $product->product_api_url = $productData['product_api_url'];
            $products[] = $product;
        }

        return $products;

        // return json_decode(file_get_contents($api));
    }
}