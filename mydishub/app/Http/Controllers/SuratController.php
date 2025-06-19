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
            'kapal_id' => 'required',
            'pemilik_id' => 'required',
            
        ]);

        Surat::create($request->all());
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
}
