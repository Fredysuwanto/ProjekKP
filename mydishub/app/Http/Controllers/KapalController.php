<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KapalController extends Controller
{
    /**
     * Tampilkan daftar kapal milik user login.
     */
    public function index()
    {
        $kapal = Kapal::where('user_id', Auth::id())->get();
        return view('kapal.index', compact('kapal'));
    }

    /**
     * Tampilkan form untuk input kapal baru.
     */
    public function create()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        if (!$pemilik) {
            return redirect()->route('pemilik.create')->with('error', 'Silakan isi data pemilik terlebih dahulu.');
        }

        return view('kapal.create', compact('pemilik'));
    }

    /**
     * Simpan data kapal baru ke database.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        if (!$pemilik) {
            return redirect()->route('pemilik.create')->with('error', 'Data pemilik belum lengkap.');
        }

        $data = $this->validated($request);
        $data['user_id'] = $user->id;
        $data['pemilik_id'] = $pemilik->id;

        if ($request->hasFile('file_stnk')) {
            $file = $request->file('file_stnk');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('stnk_files', $fileName, 'public');
            $data['file_stnk'] = $filePath;
        }

        Kapal::create($data);
        return $this->backWith('success', "{$data['nama']} berhasil disimpan.");
    }

    /**
     * Tampilkan form edit kapal.
     */
    public function edit(Kapal $kapal)
    {
        $this->authorizeKapal($kapal);

        if ($kapal->surats()->where('status', 'diproses')->exists()) {
            return $this->backWith('error', 'Kapal ini sudah digunakan dalam surat izin dan tidak dapat diedit.');
        }

        return view('kapal.edit', compact('kapal'));
    }

    /**
     * Update data kapal.
     */
    public function update(Request $request, Kapal $kapal)
    {
        $this->authorizeKapal($kapal);

        if ($kapal->surats()->where('status', 'diproses')->exists()) {
            return $this->backWith('error', 'Kapal ini sudah digunakan dalam surat izin dan tidak dapat diperbarui.');
        }

        $data = $this->validated($request);

        if ($request->hasFile('file_stnk')) {
            if ($kapal->file_stnk && Storage::disk('public')->exists($kapal->file_stnk)) {
                Storage::disk('public')->delete($kapal->file_stnk);
            }

            $file = $request->file('file_stnk');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('stnk_files', $fileName, 'public');
            $data['file_stnk'] = $filePath;
        }

        $kapal->update($data);
        return $this->backWith('success', 'Data kapal berhasil diperbarui.');
    }

    /**
     * Hapus kapal jika belum digunakan.
     */
    public function destroy(Kapal $kapal)
    {
        $this->authorizeKapal($kapal);

        if ($kapal->surats()->where('status', 'diproses')->exists()) {
            return $this->backWith('error', 'Kapal ini sudah digunakan dalam surat izin dan tidak dapat dihapus.');
        }

        $kapal->delete();
        return $this->backWith('success', 'Data kapal berhasil dihapus.');
    }

    /**
     * Validasi form input kapal.
     */
    private function validated(Request $request): array
    {
        $request->validate([
            'jenisperizinan' => 'required|in:Izin Operasional,Trayek',
        ]);

        $rules = [
            'nama' => 'required|max:25',
            'noplat' => 'required|max:16',
            'jenis' => 'required|max:16',
            'ukuran' => 'required',
            'tandaselar' => 'required',
            'daya' => 'required',
            'muatan' => 'required',
            'jenisperizinan' => 'required',
            'tujuan' => $request->jenisperizinan === 'Trayek' ? 'required|max:100' : 'nullable',
        ];

        return $request->validate($rules);
    }

    /**
     * Pastikan user yang login adalah pemilik data kapal.
     */
    private function authorizeKapal(Kapal $kapal): void
    {
        if ($kapal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin terhadap kapal ini.');
        }
    }

    /**
     * Helper untuk redirect kembali dengan notifikasi.
     */
    private function backWith(string $type, string $msg)
    {
        return redirect()->route('kapal.index')->with($type, $msg);
    }

    /**
     * Tampilkan detail kapal.
     */
    public function show(Kapal $kapal)
    {
        $this->authorizeKapal($kapal);
        return view('kapal.detail', compact('kapal'));
    }

    /**
     * Proses kapal untuk dipindahkan ke riwayat.
     */
    public function proses(Kapal $kapal)
    {
        $kapal->status = 'diproses';
        $kapal->save();

        return redirect()->route('laporan.index')->with('success', 'Kapal berhasil diproses.');
    }

    /**
     * Tolak permohonan kapal.
     */
    public function tolak(Kapal $kapal)
    {
        $kapal->status = 'ditolak';
        $kapal->save();

        return redirect()->route('laporan.index')->with('success', 'Kapal ditolak.');
    }

    /**
     * Tampilkan daftar kapal dalam proses dan perpanjangan.
     */
    public function prosesList()
    {
        $proses = Kapal::with('user')
            ->where('status', 'diproses')
            ->get();

        $proses2 = Kapal::with('user')
            ->where('status', 'diperpanjang')
            ->get();

        return view('kapal.proses', compact('proses', 'proses2'));
    }
}
