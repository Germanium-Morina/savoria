<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService implements OrderServiceInterface
{
    public function createOrderFromCart(int $userId = null, array $customer)
    {
        $cart = $customer['cart'] ?? [];
        if (empty($cart)) {
            throw new \RuntimeException('Cart is empty');
        }

        return DB::transaction(function () use ($userId, $customer, $cart) {
            $total = 0;
            $errors = [];
            foreach ($cart as $index => $item) {
                $menuItemId = $item['menu_item']['id'] ?? null;
                $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 0;

                if (! $menuItemId || $quantity < 1) {
                    $errors["cart.{$index}"] = ['Invalid item or quantity'];
                    continue;
                }

                $menuItem = MenuItem::find($menuItemId);
                if (! $menuItem) {
                    $errors["cart.{$index}"] = ['Menu item not found'];
                    continue;
                }

                if ((float)$menuItem->price <= 0) {
                    $errors["cart.{$index}"] = ['Invalid item price'];
                    continue;
                }

                $expectedLine = $quantity * (float)$menuItem->price;
                $submittedLine = isset($item['line_total']) ? (float)$item['line_total'] : null;
                // if client submitted a total, ensure it matches server calculation
                if ($submittedLine !== null && abs($submittedLine - $expectedLine) > 0.01) {
                    $errors["cart.{$index}"] = ['Line total mismatch'];
                }

                $total += $expectedLine;
            }

            if (! empty($errors)) {
                throw ValidationException::withMessages($errors);
            }

            $order = Order::create([
                'user_id' => $userId,
                'customer_name' => $customer['name'] ?? ($userId ? null : 'Guest'),
                'customer_email' => $customer['email'] ?? null,
                'customer_phone' => $customer['phone'] ?? null,
                'total_amount' => $total,
                'status' => 'pending',
                'order_type' => $customer['order_type'] ?? 'pickup',
                'delivery_address' => $customer['delivery_address'] ?? null,
                'notes' => $customer['notes'] ?? null,
            ]);

            foreach ($cart as $ci) {
                $menuItem = MenuItem::find($ci['menu_item']['id']);
                if (! $menuItem) continue;

                $quantity = (int) ($ci['quantity'] ?? 1);
                $expectedLine = $quantity * (float)$menuItem->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $quantity,
                    'unit_price' => $menuItem->price,
                    'total_price' => $expectedLine,
                    'special_instructions' => $ci['special_instructions'] ?? null,
                ]);
            }

            return $order->load('items.menuItem');
        });
    }

    public function listOrders()
    {
        return Order::with('items.menuItem')->orderByDesc('created_at')->get();
    }

    public function getOrder(int $orderId)
    {
        return Order::with('items.menuItem')->find($orderId);
    }
}
