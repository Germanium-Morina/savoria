<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Services\Contracts\CartServiceInterface;

class CartService implements CartServiceInterface
{
    public function getCart(array $session): array
    {
        $items = $session['cart'] ?? [];
        $result = [];

        foreach ($items as $menuItemId => $qty) {
            $menuItem = MenuItem::find($menuItemId);
            if (! $menuItem) continue;
            $result[] = [
                'menu_item' => $menuItem->toArray(),
                'quantity' => $qty,
                'line_total' => $qty * (float) $menuItem->price,
            ];
        }

        return $result;
    }

    public function addToCart(array &$session, int $menuItemId, int $quantity = 1): array
    {
        $cart = $session['cart'] ?? [];

        if (isset($cart[$menuItemId])) {
            $cart[$menuItemId] += $quantity;
        } else {
            $cart[$menuItemId] = $quantity;
        }

        $session['cart'] = $cart;

        return $this->getCart($session);
    }

    public function updateCart(array &$session, int $menuItemId, int $quantity): array
    {
        $cart = $session['cart'] ?? [];

        if ($quantity <= 0) {
            unset($cart[$menuItemId]);
        } else {
            $cart[$menuItemId] = $quantity;
        }

        $session['cart'] = $cart;

        return $this->getCart($session);
    }

    public function clearCart(array &$session): void
    {
        unset($session['cart']);
    }
}
