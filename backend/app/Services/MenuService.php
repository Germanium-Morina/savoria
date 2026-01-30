<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Services\Contracts\MenuServiceInterface;

class MenuService implements MenuServiceInterface
{
    public function getFeaturedItems()
    {
        return MenuItem::where('is_featured', true)
            ->where('is_available', true)
            ->orderBy('display_order')
            ->get();
    }

    public function listByCategory(int $categoryId = null)
    {
        $query = MenuItem::query()->where('is_available', true)->orderBy('display_order');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->get();
    }
}
