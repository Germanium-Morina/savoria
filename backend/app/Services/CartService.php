<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Models\CartItem;
use App\Services\Contracts\CartServiceInterface;
use Illuminate\Support\Collection;

class CartService implements CartServiceInterface
{
    public function getCart(array $session, ?int $userId = null)
    {
        // If user is authenticated, load from DB cart_items
        if ($userId) {
            $dbItems = CartItem::where('user_id', $userId)->get();
            $collection = collect();
            foreach ($dbItems as $di) {
                $menuItem = $di->menuItem;
                if (! $menuItem) continue;
                $collection->push((object)[
                    'id' => $di->id,
                    'menu_item' => $menuItem,
                    'quantity' => $di->quantity,
                    'line_total' => $di->quantity * (float) $menuItem->price,
                ]);
            }
            return $collection;
        }
        $items = $session['cart'] ?? [];
        $collection = collect();

        foreach ($items as $menuItemId => $qty) {
            $menuItem = MenuItem::find($menuItemId);
            if (! $menuItem) continue;
            $collection->push((object)[
                'id' => null,
                'menu_item' => $menuItem,
                'quantity' => $qty,
                'line_total' => $qty * (float) $menuItem->price,
            ]);
        }

        return $collection;
    }

    public function addToCart(array &$session, int $menuItemId, int $quantity = 1, ?int $userId = null)
    {
        // If user is authenticated, persist in DB
        if ($userId) {
            $ci = CartItem::where('user_id', $userId)->where('menu_item_id', $menuItemId)->first();
            if ($ci) {
                $ci->quantity += $quantity;
                $ci->save();
            } else {
                $ci = CartItem::create(['user_id' => $userId, 'menu_item_id' => $menuItemId, 'quantity' => $quantity]);
            }

            return $this->getCart($session, $userId);
        }

        $cart = $session['cart'] ?? [];

        if (isset($cart[$menuItemId])) {
            $cart[$menuItemId] += $quantity;
        } else {
            $cart[$menuItemId] = $quantity;
        }

        $session['cart'] = $cart;

        return $this->getCart($session);
    }

    public function updateCart(array &$session, int $menuItemId, int $quantity, ?int $userId = null)
    {
        if ($userId) {
            $ci = CartItem::where('user_id', $userId)->where('menu_item_id', $menuItemId)->first();
            if (! $ci && $quantity > 0) {
                CartItem::create(['user_id' => $userId, 'menu_item_id' => $menuItemId, 'quantity' => $quantity]);
            } elseif ($ci) {
                if ($quantity <= 0) {
                    $ci->delete();
                } else {
                    $ci->quantity = $quantity;
                    $ci->save();
                }
            }

            return $this->getCart($session, $userId);
        }

        $cart = $session['cart'] ?? [];

        if ($quantity <= 0) {
            unset($cart[$menuItemId]);
        } else {
            $cart[$menuItemId] = $quantity;
        }

        $session['cart'] = $cart;

        return $this->getCart($session);
    }

    public function clearCart(array &$session, ?int $userId = null): void
    {
        if ($userId) {
            CartItem::where('user_id', $userId)->delete();
            return;
        }

        unset($session['cart']);
    }
}
