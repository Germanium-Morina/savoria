<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MenuItemRequest;

class MenuItemController extends Controller
{
    public function index()
    {
        return response()->json(['data' => MenuItem::orderBy('display_order')->get()]);
    }

    public function store(MenuItemRequest $request)
    {
        $item = MenuItem::create($request->validated());
        return response()->json(['data' => $item], 201);
    }

    public function show($id)
    {
        $item = MenuItem::findOrFail($id);
        return response()->json(['data' => $item]);
    }

    public function update(MenuItemRequest $request, $id)
    {
        $item = MenuItem::findOrFail($id);
        $item->update($request->validated());
        return response()->json(['data' => $item]);
    }

    public function destroy($id)
    {
        $item = MenuItem::findOrFail($id);
        $item->delete();
        return response()->json(['success' => true]);
    }
}
