<?php
namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Kapal;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $surats = Surat::with(['kapal', 'pemilik'])->get();
        return view('surat.index', compact('surats'));
        
    }

    public function create()
    {
        $kapals = Kapal::all();
        $pemiliks = Pemilik::all();
        
        return view('surat.create', compact('kapals', 'pemiliks'));
    }

    public function store(Request $request)
{
    $request->validate([
        'kapal_id' => 'required|exists:kapals,id',
        'pemilik_id' => 'required|exists:pemiliks,id',
    ]);

    // Cek apakah kombinasi kapal dan pemilik sudah pernah dibuat
    $exists = Surat::where('kapal_id', $request->kapal_id)
                   ->where('pemilik_id', $request->pemilik_id)
                   ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'Surat untuk kapal dan pemilik ini sudah ada.');
    }

    // Buat surat baru jika belum ada
    Surat::create([
        'kapal_id' => $request->kapal_id,
        'pemilik_id' => $request->pemilik_id,
        'status' => 'Menunggu', // default status awal
    ]);

    return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat.');
}

    public function edit(Surat $surat)
    {
        $kapals = Kapal::all();
        $pemiliks = Pemilik::all();
        return view('surat.edit', compact('surat', 'kapals', 'pemiliks'));
    }

    public function update(Request $request, Surat $surat)
    {
        $surat->update($request->all());
        return redirect()->route('surat.index')->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy(Surat $surat)
    {
        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus.');
    }

    public function proses($id)
{
    $surat = Surat::findOrFail($id);
    $surat->status = 'diproses';
    $surat->save();

    return redirect()->route('surat.index')->with('success', 'Surat berhasil diproses.');
}

    public function tolak($id)
{
    $surat = Surat::findOrFail($id);
    $surat->status = 'ditolak';
    $surat->save();

    return redirect()->route('surat.index')->with('success', 'Surat berhasil ditolak.');
}
public function prosesList()
{
    $proses = Surat::with(['kapal', 'pemilik'])
                ->where('status', 'diproses')
                ->orderBy('updated_at', 'desc')
                ->get();

    return view('surat.proses', compact('proses'));
}


}
