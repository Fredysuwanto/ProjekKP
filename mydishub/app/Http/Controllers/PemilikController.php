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
    if (auth()->user()->role === 'a') {
        // Admin: lihat semua data
        $pemilik = Pemilik::all();
    } else {
        // User: hanya lihat data sendiri
        $pemilik = Pemilik::where('user_id', auth()->id())->get();
    }

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
            'file_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('file_ktp')) {
            $file = $request->file('file_ktp');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('ktp_files', $fileName, 'public');
            $val['file_ktp'] = $filePath;
        }
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

        $data = $request->only('nama', 'nik', 'alamat', 'telepon', 'email');

        // Update file KTP jika ada file baru
        if ($request->hasFile('file_ktp')) {
            // Hapus file lama jika ada
            if ($pemilik->file_ktp && Storage::disk('public')->exists($pemilik->file_ktp)) {
                Storage::disk('public')->delete($pemilik->file_ktp);
            }

            $file = $request->file('file_ktp');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('ktp_files', $fileName, 'public');
            $data['file_ktp'] = $filePath;
        }

        $pemilik->update($data);

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
