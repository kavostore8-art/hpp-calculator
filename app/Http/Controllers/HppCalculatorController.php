<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\HppDetail;
use App\Models\Material;
use Illuminate\Http\Request;

class HppCalculatorController extends Controller
{
    public function calculate(Product $product)
    {
        $product->load('hppDetail');
        $materials = Material::where('is_active', true)->get();
        
        return view('hpp.calculate', compact('product', 'materials'));
    }

    public function updateHpp(Request $request, Product $product)
    {
        $validated = $request->validate([
            'kaos_price' => 'nullable|numeric|min:0',
            'sablon_price' => 'nullable|numeric|min:0',
            'dtf_price' => 'nullable|numeric|min:0',
            'bordir_price' => 'nullable|numeric|min:0',
            'hang_tag_price' => 'nullable|numeric|min:0',
            'label_leher_price' => 'nullable|numeric|min:0',
            'label_samping_price' => 'nullable|numeric|min:0',
            'plastik_price' => 'nullable|numeric|min:0',
            'stiker_price' => 'nullable|numeric|min:0',
            'jahit_price' => 'nullable|numeric|min:0',
            'qc_price' => 'nullable|numeric|min:0',
            'packing_price' => 'nullable|numeric|min:0',
            'operasional_price' => 'nullable|numeric|min:0',
        ]);

        $hppDetail = $product->hppDetail;
        $hppDetail->update($validated);
        $hppDetail->calculateHpp();

        return redirect()->route('products.show', $product)->with('success', 'HPP calculated successfully!');
    }
}
