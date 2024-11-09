<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TrashBin;
use App\Models\WasteCategory;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['user', 'trashBin', 'wasteCategory'])->get();
        return view('user.transaksis.index', compact('transaksis'));
    }

    public function create()
    {
        $trashBins = TrashBin::all();
        $wasteCategories = WasteCategory::all();
        return view('user.transaksis.create', compact('trashBins', 'wasteCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bin_id' => 'required|exists:trash_bins,bin_id',
            'category_id' => 'required|exists:waste_categories,category_id',
            'items' => 'required|numeric|min:0',
        ]);

        $wasteCategory = WasteCategory::findOrFail($request->category_id);
        $totalAmount = $request->items * $wasteCategory->price_per_kg;

        $transaksi = new Transaksi();
        $transaksi->user_id = Auth::id(); // Ambil ID user yang sedang login
        $transaksi->bin_id = $request->bin_id;
        $transaksi->category_id = $request->category_id;
        $transaksi->items = $request->items;
        $transaksi->total_amount = $totalAmount;
        $transaksi->save();

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    
}
