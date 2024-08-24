<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'date_sale' => ['required','date'],
            'client_id' => ['required', 'numeric'],
            'items.*.product_id' => ['required', 'numeric'],
            'items.*.quantity' => ['required', 'numeric'],
            'items.*.unit_price' => ['required', 'numeric'],
        ];
    }
}
