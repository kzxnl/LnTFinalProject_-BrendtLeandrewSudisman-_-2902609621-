<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function index()
    {
        return response()->json(Product::with('category')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validated);
        return response()->json(['message' => 'Product created', 'data' => $product], 201);
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
        ]);

        $product->update($validated);
        return response()->json(['message' => 'Product updated', 'data' => $product]);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['message' => 'Product deleted']);
    }
}
