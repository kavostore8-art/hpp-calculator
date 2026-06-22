<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('createdBy')->paginate(10);
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $types = Report::TYPES;
        return view('reports.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:production,hpp,profit',
            'report_date' => 'required|date',
        ]);

        $validated['created_by'] = auth()->id();

        // Calculate totals based on type
        $products = Product::where('is_active', true)->with('hppDetail')->get();
        
        $validated['total_products'] = $products->count();
        $validated['total_production_qty'] = $products->sum('quantity');
        $validated['total_hpp'] = $products->sum(fn($p) => $p->hppDetail?->total_hpp ?? 0);

        $report = Report::create($validated);

        return redirect()->route('reports.show', $report)->with('success', 'Report created successfully!');
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    public function exportPdf(Report $report)
    {
        $pdf = PDF::loadView('reports.pdf', compact('report'));
        return $pdf->download('report-' . $report->id . '.pdf');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted!');
    }
}
