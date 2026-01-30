<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Services\Contracts\OrderServiceInterface;

class OrderController extends Controller
{
    protected OrderServiceInterface $service;

    public function __construct(OrderServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $orders = $this->service->listOrders();
        return response()->json(['data' => OrderResource::collection($orders)]);
    }

    public function show($id)
    {
        $order = $this->service->getOrder((int) $id);
        if (! $order) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json(['data' => new OrderResource($order)]);
    }
}
