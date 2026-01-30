<?php

namespace App\Services\Contracts;

interface CartServiceInterface
{
    /**
     * Return a collection of cart items (DB-backed or session-backed)
     */
    public function getCart(array $session, ?int $userId = null);

    /**
     * Add item to cart and return the updated collection
     */
    public function addToCart(array &$session, int $menuItemId, int $quantity = 1, ?int $userId = null);

    /**
     * Update cart item quantity and return the updated collection
     */
    public function updateCart(array &$session, int $menuItemId, int $quantity, ?int $userId = null);

    public function clearCart(array &$session, ?int $userId = null): void;
}
