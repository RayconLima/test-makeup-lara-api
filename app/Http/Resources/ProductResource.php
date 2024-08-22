<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'brand'             => BrandResource::make($this->brand),
            'category'          => CategoryResource::make($this->category),
            'type'              => TypeResource::make($this->type),
            'description'       => $this->description,
            'price'             => $this->price,
            'product_api_url'   => $this->product_api_url,
            'count_in_stock'    => $this->count_in_stock,
        ];
    }
}
