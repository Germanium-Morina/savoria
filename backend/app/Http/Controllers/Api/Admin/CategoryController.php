<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Category::orderBy('display_order')->get()]);
    }

    public function store(CategoryRequest $request)
    {
        $cat = Category::create($request->validated());
        return response()->json(['data' => $cat], 201);
    }

    public function show($id)
    {
        $cat = Category::findOrFail($id);
        return response()->json(['data' => $cat]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $cat = Category::findOrFail($id);
        $cat->update($request->validated());
        return response()->json(['data' => $cat]);
    }

    public function destroy($id)
    {
        $cat = Category::findOrFail($id);
        $cat->delete();
        return response()->json(['success' => true]);
    }
}
