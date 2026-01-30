<?php

namespace App\Services\Contracts;

interface CartServiceInterface
{
    public function getCart(array $session): array;

    public function addToCart(array &$session, int $menuItemId, int $quantity = 1): array;

    public function updateCart(array &$session, int $menuItemId, int $quantity): array;

    public function clearCart(array &$session): void;
}
