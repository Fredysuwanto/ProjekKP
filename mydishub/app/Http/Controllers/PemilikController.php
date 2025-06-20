<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya ambil data pemilik milik user yang login
        $pemilik = Pemilik::where('user_id', Auth::id())->get();
        return view('pemilik.index', compact('pemilik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cegah lebih dari 1 data pemilik untuk user login
        $existing = Pemilik::where('user_id', Auth::id())->exists();

        if ($existing) {
            return redirect()->route('pemilik.index')->with('error', 'Data pemilik sudah ada.');
        }

        return view('pemilik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|email|max:255',
        ]);

        // Tambahkan user_id ke data yang akan disimpan
        $val['user_id'] = Auth::id();

        Pemilik::create($val);

        return redirect()->route('pemilik.index')->with('success', $val['nama'] . ' berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemilik $pemilik)
    {
        // Pastikan user hanya bisa mengedit miliknya sendiri
        if ($pemilik->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pemilik.edit', compact('pemilik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemilik $pemilik)
    {
        if ($pemilik->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|email|max:255',
        ]);

        $pemilik->update($request->only('nama', 'nik', 'alamat', 'telepon', 'email'));

        return redirect()->route('pemilik.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemilik $pemilik)
    {
        if ($pemilik->user_id !== Auth::id()) {
            abort(403);
        }

        $pemilik->delete();

        return redirect()->route('pemilik.index')->with('success', 'Data berhasil dihapus.');
    }
}
