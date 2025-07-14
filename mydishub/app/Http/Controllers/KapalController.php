<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KapalController extends Controller
{
    /* ----------------------------------------------------------
     |  LIST
     |----------------------------------------------------------*/
    public function index()
    {
        $kapal = Kapal::where('user_id', Auth::id())->get();
        return view('kapal.index', compact('kapal'));
    }

    /* ----------------------------------------------------------
     |  CREATE
     |----------------------------------------------------------*/
    public function create()
    {
        return view('kapal.create');
    }

    public function store(Request $request)
    {
        $data            = $this->validated($request);
        $data['user_id'] = Auth::id();

        Kapal::create($data);

        return $this->backWith('success', "{$data['nama']} berhasil disimpan.");
    }

    /* ----------------------------------------------------------
     |  EDIT / UPDATE
     |----------------------------------------------------------*/
    public function edit(Kapal $kapal)
    {
        $this->authorizeKapal($kapal);

        if ($kapal->surats()->where('status', 'diproses')->exists()) {
            return $this->backWith('error', 'Kapal ini sudah digunakan dalam surat izin dan tidak dapat diedit.');
        }

        return view('kapal.edit', compact('kapal'));
    }

    public function update(Request $request, Kapal $kapal)
    {
        $this->authorizeKapal($kapal);

        if ($kapal->surats()->where('status', 'diproses')->exists()) {
            return $this->backWith('error', 'Kapal ini sudah digunakan dalam surat izin dan tidak dapat diperbarui.');
        }

        $data = $this->validated($request);
        $kapal->update($data);

        return $this->backWith('success', 'Data kapal berhasil diperbarui.');
    }

    /* ----------------------------------------------------------
     |  DELETE
     |----------------------------------------------------------*/
    public function destroy(Kapal $kapal)
    {
        $this->authorizeKapal($kapal);

        if ($kapal->surats()->where('status', 'diproses')->exists()) {
            return $this->backWith('error', 'Kapal ini sudah digunakan dalam surat izin dan tidak dapat dihapus.');
        }

        $kapal->delete();
        return $this->backWith('success', 'Data kapal berhasil dihapus.');
    }

    /* ----------------------------------------------------------
     |  HELPERS
     |----------------------------------------------------------*/

    /**
     * Validasi form input.
     * Kolom tujuan hanya wajib jika jenis izin adalah Trayek.
     */
    private function validated(Request $request): array
    {
        $request->validate([
            'jenisperizinan' => 'required|in:Izin Operasional,Trayek',
        ]);

        $rules = [
            'nama'            => 'required|max:25',
            'noplat'          => 'required|max:16',
            'jenis'           => 'required|max:16',
            'ukuran'          => 'required',
            'tandaselar'      => 'required',
            'daya'            => 'required',
            'muatan'          => 'required',
            'jenisperizinan'  => 'required',
            'tujuan'          => $request->jenisperizinan === 'Trayek' ? 'required|max:100' : 'nullable',
        ];

        return $request->validate($rules);
    }

    /**
     * Pastikan user hanya boleh mengakses kapal miliknya.
     */
    private function authorizeKapal(Kapal $kapal): void
    {
        if ($kapal->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin terhadap kapal ini.');
        }
    }

    /**
     * Helper redirect ke index dengan pesan.
     */
    private function backWith(string $type, string $msg)
    {
        return redirect()->route('kapal.index')->with($type, $msg);
    }

    public function show(Kapal $kapal)
    {
        $this->authorizeKapal($kapal);
        return view('kapal.detail', compact('kapal'));
    }
}
