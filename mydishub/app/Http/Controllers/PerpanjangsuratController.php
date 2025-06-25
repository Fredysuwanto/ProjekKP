<?php

namespace App\Http\Controllers;

use App\Models\Perpanjangsurat;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class PerpanjangsuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            if (auth()->user()->role === 'a') {
            $perpanjang = Perpanjangsurat::with(['riwayat'])->get();
        } else {
            $perpanjang = Perpanjangsurat::with(['riwayat'])
                        ->whereHas('riwayat', function ($query) {
                            $query->where('user_id', auth()->id());
                        })->get();
        }

        return view('perpanjangsurat.index', compact('perpanjang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $riwayats = Riwayat::where('user_id', auth()->id())->get();
        return view('perpanjangsurat.create', compact('riwayats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'riwayat_id' => 'required|exists:riwayats,id',
        ]);

        $exists = Riwayat::where('riwayat_id', $request->riwayat_id)
                    ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Surat untuk kapal dan pemilik ini sudah ada.');
        }

        Perpanjangsurat::create([
            'riwayat_id'   => $request->riwayat_id,
            'user_id'    => auth()->id(), // PENTING!
            'status'     => 'Menunggu',
        ]);

        return redirect()->route('perpanjangsurat.index')->with('success', 'Surat Perpanjangan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Perpanjangsurat $perpanjangsurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perpanjangsurat $perpanjangsurat)
    {
        if (auth()->user()->role === 'b' && $perpanjangsurat->user_id !== auth()->id()) {
        abort(403);
        }

        $riwayats = auth()->user()->role === 'a' ? Riwayat::all() : Riwayat::where('user_id', auth()->id())->get();
        return view('perpanjangsurat.edit', compact('perpanjangsurat', 'riwayats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perpanjangsurat $perpanjangsurat)
    {
            if (auth()->user()->role === 'b' && $perpanjangsurat->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'riwayat_id' => 'required|exists:riwayats,id',
        ]);

        $perpanjangsurat->update([
            'riwayat_id'   => $request->riwayat_id,
        ]);

        return redirect()->route('perpanjangsurat.index')->with('success', 'Surat Perpanjangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perpanjangsurat $perpanjangsurat)
    {
            if (auth()->user()->role === 'b' && $perpanjangsurat->user_id !== auth()->id()) {
            abort(403);
        }

        $perpanjangsurat->delete();
        return redirect()->route('perpanjangsurat.index')->with('success', 'Surat Perpanjgan berhasil dihapus.');
    }

    public function proses($id)
    {
        $perpanjangsurat = Perpanjangsurat::findOrFail($id);
        $perpanjangsurat->status = 'diproses';
        $perpanjangsurat->save();

        return redirect()->route('perpanjangsurat.index')->with('success', 'Surat berhasil diproses.');
    }

    public function tolak($id)
    {
        $perpanjangsurat = Perpanjangsurat::findOrFail($id);
        $perpanjangsurat->status = 'ditolak';
        $perpanjangsurat->save();

        return redirect()->route('perpanjangsurat.index')->with('success', 'Surat berhasil ditolak.');
    }

    public function prosesList()
    {
        if (auth()->user()->role === 'a') {
            $proses = Perpanjangsurat::with(['riwayat'])
                        ->where('status', 'diproses')
                        ->orderBy('updated_at', 'desc')
                        ->get();
        } else {
            $proses = Perpanjangsurat::with(['riwayat'])
                        ->where('status', 'diproses')
                        ->whereHas('riwayat', function ($q) {
                            $q->where('user_id', auth()->id());
                        })
                        ->orderBy('updated_at', 'desc')
                        ->get();
        }

        return view('perpanjangsurat.proses', compact('proses'));
    }
}
