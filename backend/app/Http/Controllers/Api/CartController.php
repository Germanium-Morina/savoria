<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\CartServiceInterface;
use App\Http\Resources\CartItemResource;
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
        $userId = $request->user()?->id ?? null;
        $cart = $this->cartService->getCart($session, $userId);
        return response()->json(['data' => CartItemResource::collection($cart)]);
    }

    public function add(CartAddRequest $request)
    {
        $data = $request->validated();
        $session = $request->session()->all();
        $userId = $request->user()?->id ?? null;
        $cart = $this->cartService->addToCart($session, $data['menu_item_id'], $data['quantity'] ?? 1, $userId);
        // persist session changes
        if (isset($session['cart'])) $request->session()->put('cart', $session['cart']);

        return response()->json(['data' => CartItemResource::collection($cart)]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'menu_item_id' => 'required|integer|exists:menu_items,id',
            'quantity' => 'required|integer',
        ]);
        $session = $request->session()->all();
        $userId = $request->user()?->id ?? null;
        $cart = $this->cartService->updateCart($session, $data['menu_item_id'], $data['quantity'], $userId);
        if (isset($session['cart'])) $request->session()->put('cart', $session['cart']);

        return response()->json(['data' => CartItemResource::collection($cart)]);
    }

    public function clear(Request $request)
    {
        $session = $request->session()->all();
        $userId = $request->user()?->id ?? null;
        $this->cartService->clearCart($session, $userId);
        $request->session()->forget('cart');
        return response()->json(['data' => []]);
    }

    public function remove(Request $request, $menuItemId)
    {
        // remove a single menu item from cart
        $session = $request->session()->all();
        $userId = $request->user()?->id ?? null;
        $cart = $this->cartService->updateCart($session, (int) $menuItemId, 0, $userId);
        if (isset($session['cart'])) $request->session()->put('cart', $session['cart']);
        return response()->json(['data' => CartItemResource::collection($cart)]);
    }
}
