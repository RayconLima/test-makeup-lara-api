<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'cpf_cnpj'      => $this->cpf_cnpj,
            'address'       => $this->address,
            'number'        => $this->number,
            'city'          => $this->city,
            'state'         => $this->state,
            'zipcode'       => $this->zipcode,
            'complement'    => $this->complement,
        ];
    }
}
