<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Contracts\MenuServiceInterface;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected MenuServiceInterface $menuService;

    public function __construct(MenuServiceInterface $menuService)
    {
        $this->menuService = $menuService;
    }

    public function featured()
    {
        return response()->json(['data' => $this->menuService->getFeaturedItems()]);
    }

    public function list(Request $request)
    {
        $categoryId = $request->query('category_id');
        return response()->json(['data' => $this->menuService->listByCategory($categoryId)]);
    }
}
