<?php

namespace App\Http\Controllers;

use App\Models\Perpanjangsurat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PerpanjangsuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            if (auth()->user()->role === 'a') {
            $perpanjang = Perpanjangsurat::with(['surat'])->get();
        } else {
            $perpanjang = Perpanjangsurat::with(['surat'])
                        ->whereHas('surat', function ($query) {
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
    $surats = Surat::with(['kapal', 'pemilik'])
                    ->where('status', 'diproses')
                    ->get();

    return view('perpanjangsurat.create', compact('surats'));
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
$surat = Surat::findOrFail($request->surat_id);
$tanggal_pengajuan = Carbon::parse($surat->updated_at);

if (now()->lessThan($tanggal_pengajuan->addYears(5))) {
    return back()->with('error', 'Perpanjangan hanya dapat dilakukan setelah 5 tahun dari pengajuan terakhir.');
}
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

        $surats = auth()->user()->role === 'a' ? Surat::all() : Surat::where('user_id', auth()->id())->get();
        return view('perpanjangsurat.edit', compact('perpanjangsurat', 'surats'));
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
            'surat_id' => 'required|exists:surats,id',
        ]);

        $perpanjangsurat->update([
            'surat_id'   => $request->surat_id,
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

    public function proses2($id)
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

    public function proses2List()
    {
        if (auth()->user()->role === 'a') {
            $proses2 = Perpanjangsurat::with(['surat'])
                        ->where('status', 'diproses')
                        ->orderBy('updated_at', 'desc')
                        ->get();
        } else {
            $proses2 = Perpanjangsurat::with(['surat'])
                        ->where('status', 'diproses')
                        ->whereHas('surat', function ($q) {
                            $q->where('user_id', auth()->id());
                        })
                        ->orderBy('updated_at', 'desc')
                        ->get();
        }

        return view('perpanjangsurat.proses2', compact('proses2'));
    }
}