<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KapalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya ambil kapal milik user login
        $kapal = Kapal::where('user_id', Auth::id())->get();
        return view('kapal.index', compact('kapal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kapal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'nama' => "required|max:25",
            'noplat' => "required|max:16",
            'jenis' => "required|max:16",
            'ukuran' => "required",
            'daya' => "required",
            'muatan' => "required",
            'jenisperizinan' => "required",
        ]);

        // Tambahkan user_id sebelum simpan
        $val['user_id'] = Auth::id();

        Kapal::create($val);
        return redirect()->route('kapal.index')->with('success', $val['nama'] . ' berhasil disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kapal $kapal)
    {
        if ($kapal->user_id !== Auth::id()) {
            abort(403);
        }

        return view('kapal.edit', compact('kapal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kapal $kapal)
    {
        if ($kapal->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama' => "required|max:25",
            'noplat' => "required|max:16",
            'jenis' => "required|max:16",
            'ukuran' => "required",
            'daya' => "required",
            'muatan' => "required",
            'jenisperizinan' => "required",
        ]);

        $kapal->update($request->only([
            'nama', 'noplat', 'jenis', 'ukuran', 'daya', 'muatan', 'jenisperizinan'
        ]));

        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kapal $kapal)
    {
        if ($kapal->user_id !== Auth::id()) {
            abort(403);
        }

        $kapal->delete();
        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil dihapus.');
    }
}
