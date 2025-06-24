<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KapalController extends Controller
{
    /**
     * Menampilkan daftar kapal milik user yang sedang login.
     */
    public function index()
    {
        $kapal = Kapal::where('user_id', Auth::id())->get();
        return view('kapal.index', compact('kapal'));
    }

    /**
     * Menampilkan form tambah kapal baru.
     */
    public function create()
    {
        return view('kapal.create');
    }

    /**
     * Menyimpan data kapal baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:25',
            'noplat' => 'required|max:16',
            'jenis' => 'required|max:16',
            'ukuran' => 'required',
            'tandaselar' => 'required',
            'daya' => 'required',
            'muatan' => 'required',
            'jenisperizinan' => 'required',
        ]);

        $validated['user_id'] = Auth::id();

        Kapal::create($validated);

        return redirect()->route('kapal.index')->with('success', "{$validated['nama']} berhasil disimpan.");
    }

    /**
     * Menampilkan form edit jika kapal belum digunakan.
     */
    public function edit(Kapal $kapal)
    {
        $this->authorizeKapal($kapal);

        if ($kapal->riwayat()->exists()) {
            return redirect()->route('kapal.index')
                ->with('error', 'Kapal ini sudah digunakan dalam surat izin dan tidak dapat diedit.');
        }

        return view('kapal.edit', compact('kapal'));
    }

    /**
     * Memperbarui data kapal.
     */
    public function update(Request $request, Kapal $kapal)
    {
        $this->authorizeKapal($kapal);

        if ($kapal->riwayat()->exists()) {
            return redirect()->route('kapal.index')
                ->with('error', 'Kapal ini sudah digunakan dalam surat izin dan tidak dapat diperbarui.');
        }

        $validated = $request->validate([
            'nama' => 'required|max:25',
            'noplat' => 'required|max:16',
            'jenis' => 'required|max:16',
            'ukuran' => 'required',
            'tandaselar' => 'required',
            'daya' => 'required',
            'muatan' => 'required',
            'jenisperizinan' => 'required',
        ]);

        $kapal->update($validated);

        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil diperbarui.');
    }

    /**
     * Menghapus kapal jika belum digunakan dalam riwayat.
     */
    public function destroy(Kapal $kapal)
    {
        $this->authorizeKapal($kapal);

        if ($kapal->riwayat()->exists()) {
            return redirect()->route('kapal.index')
                ->with('error', 'Kapal ini sudah digunakan dalam surat izin dan tidak dapat dihapus.');
        }

        $kapal->delete();

        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil dihapus.');
    }

    /**
     * Memastikan hanya pemilik kapal yang boleh mengakses/ubah.
     */
    private function authorizeKapal(Kapal $kapal)
    {
        if ($kapal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin terhadap kapal ini.');
        }
    }
}
