<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => (float) $this->price,
            'image_url' => $this->image_url,
            'is_available' => (bool) $this->is_available,
            'is_featured' => (bool) $this->is_featured,
            'display_order' => $this->display_order,
        ];
    }
}
