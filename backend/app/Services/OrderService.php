<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    public function createOrderFromCart(int $userId = null, array $customer): array
    {
        $cart = $customer['cart'] ?? [];
        if (empty($cart)) {
            throw new \RuntimeException('Cart is empty');
        }

        return DB::transaction(function () use ($userId, $customer, $cart) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['line_total'] ?? 0;
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

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $ci['quantity'],
                    'unit_price' => $menuItem->price,
                    'total_price' => $ci['line_total'],
                    'special_instructions' => $ci['special_instructions'] ?? null,
                ]);
            }

            return $order->load('items.menuItem')->toArray();
        });
    }
}
