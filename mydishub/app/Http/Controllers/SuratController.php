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
        if (auth()->user()->role === 'a') {
            $surats = Surat::with(['kapal', 'pemilik'])->get();
        } else {
            $surats = Surat::with(['kapal', 'pemilik'])
                        ->whereHas('kapal', function ($query) {
                            $query->where('user_id', auth()->id());
                        })->get();
        }

        return view('surat.index', compact('surats'));
    }

    public function create()
    {
        $kapals = Kapal::where('user_id', auth()->id())->get();
        $pemiliks = Pemilik::where('user_id', auth()->id())->get();

        return view('surat.create', compact('kapals', 'pemiliks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kapal_id' => 'required|exists:kapals,id',
            'pemilik_id' => 'required|exists:pemiliks,id',
        ]);

        $exists = Surat::where('kapal_id', $request->kapal_id)
                    ->where('pemilik_id', $request->pemilik_id)
                    ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Surat untuk kapal dan pemilik ini sudah ada.');
        }

        Surat::create([
            'kapal_id'   => $request->kapal_id,
            'pemilik_id' => $request->pemilik_id,
            'user_id'    => auth()->id(), // PENTING!
            'status'     => 'Menunggu',
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat.');
    }

    public function edit(Surat $surat)
    {
        // Validasi agar user tidak bisa edit milik user lain (opsional tapi disarankan)
        if (auth()->user()->role === 'b' && $surat->user_id !== auth()->id()) {
            abort(403);
        }

        $kapals = auth()->user()->role === 'a' ? Kapal::all() : Kapal::where('user_id', auth()->id())->get();
        $pemiliks = auth()->user()->role === 'a' ? Pemilik::all() : Pemilik::where('user_id', auth()->id())->get();

        return view('surat.edit', compact('surat', 'kapals', 'pemiliks'));
    }

    public function update(Request $request, Surat $surat)
    {
        if (auth()->user()->role === 'b' && $surat->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'kapal_id' => 'required|exists:kapals,id',
            'pemilik_id' => 'required|exists:pemiliks,id',
        ]);

        $surat->update([
            'kapal_id'   => $request->kapal_id,
            'pemilik_id' => $request->pemilik_id,
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy(Surat $surat)
    {
        if (auth()->user()->role === 'b' && $surat->user_id !== auth()->id()) {
            abort(403);
        }

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
        if (auth()->user()->role === 'a') {
            $proses = Surat::with(['kapal', 'pemilik'])
                        ->where('status', 'diproses')
                        ->orderBy('updated_at', 'desc')
                        ->get();
        } else {
            $proses = Surat::with(['kapal', 'pemilik'])
                        ->where('status', 'diproses')
                        ->whereHas('kapal', function ($q) {
                            $q->where('user_id', auth()->id());
                        })
                        ->orderBy('updated_at', 'desc')
                        ->get();
        }

        return view('surat.proses', compact('proses'));
    }
}
