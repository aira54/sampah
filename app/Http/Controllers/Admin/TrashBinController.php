<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrashBin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TrashBinController extends Controller
{
    public function index()
    {
        $daftarTrashBin = TrashBin::all();

        return view('admin.trash_bins.index', compact('daftarTrashBin'));
    }

    public function create()
    {
        return view('admin.trash_bins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        $trashBin = new TrashBin;
        $trashBin->name = $request->name;
        $trashBin->location = $request->location;
        $trashBin->status = $request->status;
        $trashBin->bin_id = uniqid('BIN'); // ID unik untuk setiap trash bin

        // Simpan data TrashBin terlebih dahulu untuk memastikan `bin_id` tersimpan di database
        $trashBin->save();

        // Generate QR code dalam format SVG dengan URL yang sesuai
        $qrContent = url('/api/activate-lid?bin_id='.$trashBin->bin_id);
        $qrFileName = 'qr_codes/'.$trashBin->bin_id.'.svg';
        Storage::put($qrFileName, QrCode::format('svg')->size(300)->generate($qrContent));

        // Perbarui path QR code pada field `qr_code_path` dan simpan ulang
        $trashBin->qr_code_path = $qrFileName;
        $trashBin->qr_code = $trashBin->bin_id; // Pastikan untuk mengisi qr_code dengan bin_id jika itu yang dimaksud
        $trashBin->save();

        return redirect()->route('trash_bins.index')->with('success', 'Trash Bin berhasil ditambahkan.');
    }

    // Method untuk halaman edit
    public function edit(TrashBin $trashBin)
    {
        return view('admin.trash_bins.edit', compact('trashBin'));
    }

    // Method untuk update data TrashBin
    public function update(Request $request, TrashBin $trashBin)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        // Memperbarui data TrashBin
        $trashBin->name = $request->name;
        $trashBin->location = $request->location;
        $trashBin->status = $request->status;

        // Hapus QR code lama jika ada
        if ($trashBin->qr_code_path) {
            Storage::delete($trashBin->qr_code_path);
        }

        // Generate QR code baru dalam format SVG dengan URL yang sesuai
        $qrContent = url('/api/activate-lid?bin_id='.$trashBin->bin_id);
        $qrFileName = 'qr_codes/'.$trashBin->bin_id.'.svg';
        Storage::put($qrFileName, QrCode::format('svg')->size(300)->generate($qrContent));

        // Simpan path QR code baru
        $trashBin->qr_code_path = $qrFileName;
        $trashBin->qr_code = $trashBin->bin_id; // Pastikan untuk mengisi qr_code dengan bin_id
        $trashBin->save();

        return redirect()->route('trash_bins.index')->with('success', 'Trash Bin berhasil diperbarui.');
    }

    public function activateLid(Request $request)
    {
        $binId = $request->query('bin_id');
        $trashBin = TrashBin::where('bin_id', $binId)->first();

        if (! $trashBin) {
            return response()->json(['message' => 'Trash bin not found.'], 404);
        }

        // Pastikan status trash bin aktif
        if ($trashBin->status !== 'active') {
            return response()->json(['message' => 'Trash bin is inactive.'], 403);
        }

        // Mengembalikan pesan untuk membuka tutup
        return response()->json(['message' => 'Lid opened successfully.']);
    }

    public function destroy(TrashBin $trashBin)
    {
        if ($trashBin->qr_code_path) {
            Storage::delete($trashBin->qr_code_path);
        }

        $trashBin->delete();

        return redirect()->route('trash_bins.index')->with('success', 'Trash Bin berhasil dihapus.');
    }
}
