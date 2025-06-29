<?php

namespace App\Http\Controllers;

use App\Models\Perpanjangsurat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'a') {
            $riwayat = Surat::with(['kapal', 'pemilik'])->where('status', 'diproses')->get();
            $riwayat2 = Perpanjangsurat::with(['surat.kapal', 'surat.pemilik'])->where('status', 'diproses')->get();
        } else {
            $riwayat = Surat::with(['kapal', 'pemilik'])
                        ->where('status', 'diproses')
                        ->whereHas('kapal', function ($query) {
                            $query->where('user_id', auth()->id());
                        })->get();
            $riwayat2 = Perpanjangsurat::with(['surat.kapal', 'surat.pemilik'])
                        ->where('status', 'diproses')
                        ->whereHas('surat.kapal', function ($query) {
                            $query->where('user_id', auth()->id());
                        })->get();
        }

        return view('riwayat.index', compact('riwayat','riwayat2'));
    }

    public function cetakPDF($id)
    {
        $surat = Surat::with(['kapal', 'pemilik'])->findOrFail($id);
        $perpanjangsurat = Perpanjangsurat::with(['surat.kapal', 'surat.pemilik'])->findOrFail($id);
        // Hanya pemilik data atau admin yang bisa akses
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

        // Tambahan data agar sesuai dengan kebutuhan blade (khusus surat trayek seperti contoh)
        $pemohon = $surat->pemilik;
        $kapal = $surat->kapal;
        $tanggal = Carbon::parse($surat->updated_at)->translatedFormat('d F Y');
        $berlaku_sampai = Carbon::parse($surat->updated_at)->addYears(5)->translatedFormat('d F Y');

        $pdf = Pdf::loadView($view, compact('surat', 'pemohon', 'kapal', 'tanggal', 'berlaku_sampai'));
        return $pdf->download('surat-izin-kapal.pdf');
    }

    public function show($id)
    {
        $surat = Surat::with(['pemilik', 'kapal'])->findOrFail($id);
        $perpanjangsurat = Perpanjangsurat::with(['surat.kapal','surat.pemilik'])->findOrFail($id);
        return view('riwayat.detail', compact('surat','perpanjangsurat'));
    }
}
