<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string'],
            'email'         => ['required', 'string'],
            'phone'         => ['required', 'numeric'],
            'cpf_cnpj'      => ['required', 'numeric'],
            'address'       => ['required', 'string'],
            'number'        => ['required', 'numeric'],
            'city'          => ['required', 'string'],
            'state'         => ['required', 'string'],
            'zipcode'       => ['required', 'numeric'],
            'complement'    => ['nullable', 'string'],
        ];
    }
}
