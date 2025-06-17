<?php
namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Kapal;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayats = Riwayat::with('kapal')->get();
        return view('riwayat.index', compact('riwayats'));
    }

    public function create()
    {
        $kapals = Kapal::all();
        return view('riwayat.create', compact('kapals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nosurat' => "required|max:16",
            'kapal_id' => 'required',
            'file_surat' => 'nullable|mimes:pdf|max:2048', // validasi pdf
        ]);
        $riwayat = new Riwayat();
        $riwayat->nosurat = $request->nosurat;
        $riwayat->kapal_id = $request->kapal_id;
        if ($request->hasFile('file_surat')) {
            $filename = time() . '_' . $request->file('file_surat')->getClientOriginalName();
            $path = $request->file('file_surat')->storeAs('surats', $filename, 'public');
            $riwayat->file_surat = $path;
        }

        $riwayat->save();
            return redirect()->route('riwayat.index')->with('success', 'Riwayat berhasil ditambahkan');
    }

    public function edit(Riwayat $riwayat)
    {
        $kapals = Kapal::all(); // ✅ Benar
        return view('riwayat.edit', compact('riwayat', 'kapals'));
    }

        public function update(Request $request, Riwayat $riwayat)
        {
            $request->validate([
                'nosurat' => "required|max:16",
                'kapal_id' => 'required',
                'file_surat' => 'nullable|mimes:pdf|max:2048', // validasi file PDF
            ]);
        $riwayat->nosurat = $request->nosurat;
        $riwayat->kapal_id = $request->kapal_id;
        if ($request->hasFile('file_surat')) {
        // Simpan file baru
        if ($request->hasFile('file_surat')) {
        $filename = time() . '_' . $request->file('file_surat')->getClientOriginalName();
        $path = $request->file('file_surat')->storeAs('surats', $filename, 'public');
        $riwayat->file_surat = $path;
    }

    $riwayat->save(); // HANYA ini

    return redirect()->route('riwayat.index')->with('success', 'Riwayat berhasil diperbarui');
        }
    }
        public function destroy(Riwayat $riwayat)
    {
        $riwayat->delete();
        return redirect()->route('riwayat.index')->with('success', 'riwayat berhasil dihapus.');
    }
}
