<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'a') {
            $riwayat = Surat::with(['kapal', 'pemilik'])->where('status', 'diproses')->get();
        } else {
            $riwayat = Surat::with(['kapal', 'pemilik'])
                        ->where('status', 'diproses')
                        ->whereHas('kapal', function($query) {
                            $query->where('user_id', auth()->id());
                        })->get();
        }

        return view('riwayat.index', compact('riwayat'));
    }

    public function cetakPDF($id)
    {
        $surat = Surat::with(['kapal', 'pemilik'])->findOrFail($id);

        // Tambahkan validasi agar user hanya bisa cetak surat miliknya sendiri
        if (auth()->user()->role !== 'a' && $surat->kapal->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke surat ini.');
        }

        $jenisPerizinan = strtolower($surat->kapal->jenisperizinan);

        if ($jenisPerizinan === 'trayek') {
            $view = 'riwayat.trayek';
        } elseif ($jenisPerizinan === 'izin operasional') {
            $view = 'riwayat.operasional';
        } else {
            abort(404, 'Jenis perizinan tidak dikenali.');
        }

        $pdf = Pdf::loadView($view, compact('surat'));
        return $pdf->download('surat-izin-kapal.pdf');
    }
}
