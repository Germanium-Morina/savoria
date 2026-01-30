<?php

namespace App\Services\Contracts;

interface OrderServiceInterface
{
    /**
     * Create an order from cart data and return the created Order model
     */
    public function createOrderFromCart(int $userId = null, array $customer);

    /**
     * Return a collection of orders (with items)
     */
    public function listOrders();

    /**
     * Return a single Order model or null
     */
    public function getOrder(int $orderId);
}
