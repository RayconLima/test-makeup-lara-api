<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total'         =>  $this->total,
            'date_sale'     =>  $this->date_sale,
            'user'          =>  UserResource::make($this->user),
            'client'        =>  ClientResource::make($this->client),
            'items'         =>  ItemSaleResource::collection($this->items)
        ];
    }
}
