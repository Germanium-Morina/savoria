<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'order_type' => 'in:pickup,delivery',
            'delivery_address' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
