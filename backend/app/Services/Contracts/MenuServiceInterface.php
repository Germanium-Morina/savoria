<?php

namespace App\Services\Contracts;

interface MenuServiceInterface
{
    /**
     * Return featured menu items.
     *
     * @return array
     */
    public function getFeaturedItems(): array;

    /**
     * Return menu items by category, paginated or full.
     */
    public function listByCategory(int $categoryId = null): array;
}
