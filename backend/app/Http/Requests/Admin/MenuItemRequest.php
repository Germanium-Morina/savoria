<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'category_id' => 'nullable|integer|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'image_url' => 'nullable|url',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'display_order' => 'integer|min:0',
        ];
    }
}
