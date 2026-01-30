<?php

namespace App\Services\Contracts;

interface OrderServiceInterface
{
    public function createOrderFromCart(int $userId = null, array $customer): array;
}
