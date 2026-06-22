<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\HppDetail;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->with('hppDetail')
            ->paginate(10);
        
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:products,code',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();
        $product = Product::create($validated);

        // Create empty HPP Detail
        HppDetail::create(['product_id' => $product->id]);

        return redirect()->route('products.show', $product)->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        $product->load('hppDetail', 'priceSimulations');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('hppDetail');
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);

        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->update(['is_active' => false]);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
