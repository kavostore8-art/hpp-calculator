<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PriceSimulation;
use Illuminate\Http\Request;

class PriceSimulationController extends Controller
{
    public function create(Product $product)
    {
        $product->load('hppDetail');
        return view('simulations.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'margin_percent' => 'required|numeric|min:0|max:1000',
        ]);

        $simulation = PriceSimulation::create([
            'product_id' => $product->id,
            'margin_percent' => $validated['margin_percent'],
            'created_by' => auth()->id(),
        ]);

        $simulation->calculatePrice();

        return redirect()->route('products.show', $product)->with('success', 'Price simulation created!');
    }

    public function destroy(PriceSimulation $simulation)
    {
        $product = $simulation->product;
        $simulation->delete();
        
        return redirect()->route('products.show', $product)->with('success', 'Simulation deleted!');
    }
}
