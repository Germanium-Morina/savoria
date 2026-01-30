<?php

namespace App\Services\Contracts;

interface MenuServiceInterface
{
    /**
     * Return featured menu items as Eloquent collection.
     */
    public function getFeaturedItems();

    /**
     * Return menu items by category as Eloquent collection.
     */
    public function listByCategory(int $categoryId = null);
}
