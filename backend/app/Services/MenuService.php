<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Services\Contracts\MenuServiceInterface;

class MenuService implements MenuServiceInterface
{
    public function getFeaturedItems(): array
    {
        $items = MenuItem::where('is_featured', true)
            ->where('is_available', true)
            ->orderBy('display_order')
            ->get();

        return $items->toArray();
    }

    public function listByCategory(int $categoryId = null): array
    {
        $query = MenuItem::query()->where('is_available', true)->orderBy('display_order');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->get()->toArray();
    }
}
