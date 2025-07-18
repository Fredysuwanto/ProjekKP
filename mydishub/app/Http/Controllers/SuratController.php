<?php

namespace App\Http\Controllers;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Carbon;

class SuratController extends Controller
{
    /**
     * Tampilkan daftar kapal milik user login.
     */
    public function index()
    {
        $surat = Surat::where('user_id', Auth::id())->get();
        return view('surat.index', compact('surat'));
    }

    /**
     * Tampilkan form untuk input surat baru.
     */
    public function create()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        if (!$pemilik) {
            return redirect()->route('pemilik.create')->with('error', 'Silakan isi data pemilik terlebih dahulu.');
        }

        return view('surat.create', compact('pemilik'));
    }

    /**
     * Simpan data surat baru ke database.
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

        Surat::create($data);
        return $this->backWith('success', "{$data['nama']} berhasil disimpan.");
    }

    /**
     * Tampilkan form edit kapal.
     */
    public function edit(Surat $surat)
    {
        $this->authorizeSurat($surat);

        // if ($surat->surats()->where('status', 'diproses')->exists()) {
        //     return $this->backWith('error', 'surat ini sudah digunakan dalam surat izin dan tidak dapat diedit.');
        // }

        return view('surat.edit', compact('surat'));
    }

    /**
     * Update data surat.
     */
    public function update(Request $request, Surat $surat)
    {
        $this->authorizeSurat($surat);

        if ($surat->surats()->where('status', 'diproses')->exists()) {
            return $this->backWith('error', 'surat ini sudah digunakan dalam surat izin dan tidak dapat diperbarui.');
        }

        $data = $this->validated($request);

        if ($request->hasFile('file_stnk')) {
            if ($surat->file_stnk && Storage::disk('public')->exists($surat->file_stnk)) {
                Storage::disk('public')->delete($surat->file_stnk);
            }

            $file = $request->file('file_stnk');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('stnk_files', $fileName, 'public');
            $data['file_stnk'] = $filePath;
        }

        $surat->update($data);
        return $this->backWith('success', 'Data surat berhasil diperbarui.');
    }

    /**
     * Hapus surat jika belum digunakan.
     */
    public function destroy(Surat $surat)
    {
        $this->authorizeSurat($surat);

        if ($surat->surats()->where('status', 'diproses')->exists()) {
            return $this->backWith('error', 'surat ini sudah digunakan dalam surat izin dan tidak dapat dihapus.');
        }

        $surat->delete();
        return $this->backWith('success', 'Data surat berhasil dihapus.');
    }

    /**
     * Validasi form input surat.
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
     * Pastikan user yang login adalah pemilik data surat.
     */
    private function authorizeSurat(Surat $surat): void
    {
        if ($surat->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin terhadap surat ini.');
        }
    }

    /**
     * Helper untuk redirect kembali dengan notifikasi.
     */
    private function backWith(string $type, string $msg)
    {
        return redirect()->route('surat.index')->with($type, $msg);
    }

    /**
     * Tampilkan detail kapal.
     */
    public function show(Surat $surat)
    {
        $this->authorizeSurat($surat);
        return view('surat.detail', compact('surat'));
    }

    /**
     * Proses surat untuk dipindahkan ke riwayat.
     */
    public function proses(Surat $surat)
    {
        
        $surat->status = 'diproses';
        $surat->save();

        return redirect()->route('laporan.index')->with('success', 'surat berhasil diproses.');
    }

    /**
     * Tolak permohonan surat.
     */
    public function tolak(Surat $surat)
    {
        $surat->status = 'ditolak';
        $surat->save();

        return redirect()->route('laporan.index')->with('success', 'surat ditolak.');
    }

    /**
     * Tampilkan daftar surat dalam proses dan perpanjangan.
     */
    public function prosesList()
    {
        $proses = Surat::with('user')
            ->where('status', 'diproses')
            ->get();

        $proses2 = Surat::with('user')
            ->where('status', 'diperpanjang')
            ->get();

        return view('surat.proses', compact('proses', 'proses2'));
    }
}
