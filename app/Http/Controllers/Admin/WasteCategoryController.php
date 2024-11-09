<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteCategory;
use Illuminate\Support\Facades\Storage;

class WasteCategoryController extends Controller
{
    public function index()
    {
        $wasteCategories = WasteCategory::all();
        return view('admin.waste_categories.index', compact('wasteCategories'));
    }

    public function create()
    {
        return view('admin.waste_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'price_per_kg' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',

        ]);

        $wasteCategory = new WasteCategory();
        $wasteCategory->name = $request->name;
        $wasteCategory->description = $request->description;
        $wasteCategory->price_per_kg = $request->price_per_kg;
        $wasteCategory->status = $request->status;

        $wasteCategory->save();

        return redirect()->route('waste_categories.index')->with('success', 'Waste Category berhasil ditambahkan.');
    }

    public function edit(WasteCategory $wasteCategory)
    {
        return view('admin.waste_categories.edit', compact('wasteCategory'));
    }

    public function update(Request $request, WasteCategory $wasteCategory)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'price_per_kg' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',

        ]);

        $wasteCategory->name = $request->name;
        $wasteCategory->description = $request->description;
        $wasteCategory->price_per_kg = $request->price_per_kg;
        $wasteCategory->status = $request->status;

        $wasteCategory->save();

        return redirect()->route('waste_categories.index')->with('success', 'Waste Category berhasil diperbarui.');
    }

    public function destroy(WasteCategory $wasteCategory)
    {
        $wasteCategory->delete();

        return redirect()->route('waste_categories.index')->with('success', 'Waste Category berhasil dihapus.');
    }
}
