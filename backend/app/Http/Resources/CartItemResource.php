<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? null,
            'menu_item' => new MenuItemResource($this->whenLoaded('menuItem') ?? $this->menu_item),
            'quantity' => (int) ($this->quantity ?? ($this->menu_item->quantity ?? 0)),
            'line_total' => isset($this->line_total) ? (float) $this->line_total : (isset($this->menu_item) ? (float) ($this->menu_item->price * ($this->quantity ?? 1)) : null),
        ];
    }
}
