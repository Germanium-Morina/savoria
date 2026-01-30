<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;

class OrderController extends Controller
{
    protected OrderServiceInterface $service;

    public function __construct(OrderServiceInterface $service)
    {
        $this->service = $service;
    }

    public function checkout(CheckoutRequest $request)
    {
        $data = $request->validated();

        $session = $request->session()->all();
        $data['cart'] = $session['cart'] ?? [];

        $order = $this->service->createOrderFromCart($request->user()?->id ?? null, $data);

        // clear cart
        $request->session()->forget('cart');

        return response()->json(['data' => $order], 201);
    }
}
