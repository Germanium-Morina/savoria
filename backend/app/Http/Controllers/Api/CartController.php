<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\CartServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\CartAddRequest;

class CartController extends Controller
{
    protected CartServiceInterface $cartService;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    public function get(Request $request)
    {
        $session = $request->session()->all();
        return response()->json(['data' => $this->cartService->getCart($session)]);
    }

    public function add(CartAddRequest $request)
    {
        $data = $request->validated();

        $session = $request->session()->all();
        $cart = $this->cartService->addToCart($session, $data['menu_item_id'], $data['quantity'] ?? 1);
        // persist session changes
        $request->session()->put('cart', $session['cart']);

        return response()->json(['data' => $cart]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'menu_item_id' => 'required|integer|exists:menu_items,id',
            'quantity' => 'required|integer',
        ]);

        $session = $request->session()->all();
        $cart = $this->cartService->updateCart($session, $data['menu_item_id'], $data['quantity']);
        $request->session()->put('cart', $session['cart']);

        return response()->json(['data' => $cart]);
    }

    public function clear(Request $request)
    {
        $session = $request->session()->all();
        $this->cartService->clearCart($session);
        $request->session()->forget('cart');
        return response()->json(['data' => []]);
    }
}
