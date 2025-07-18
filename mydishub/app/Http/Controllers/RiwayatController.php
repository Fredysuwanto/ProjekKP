<?php

namespace App\Http\Controllers;

use App\Models\Perpanjangsurat;
use App\Models\Surat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    /**
     * Menampilkan daftar riwayat kapal yang diproses
     */
    public function index()
    {
        if (auth()->user()->role === 'a') {
            // Admin melihat semua kapal yang diproses
            $surats = Surat::with('user')->where('status', 'diproses')->get();
            $riwayat2 = Perpanjangsurat::with(['surat'])->where('status', 'diproses')->get();
        } else {
            // Pemilik hanya melihat Suratnya sendiri
            $surats = Surat::with('user')
                        ->where('status', 'diproses')
                        ->where('user_id', auth()->id())
                        ->get();
                $riwayat2 = Perpanjangsurat::with(['surat'])
                        ->where('status', 'diproses')
                        ->whereHas('surat', function ($query) {
                            $query->where('user_id', auth()->id());
                        })->get();
        }

        return view('riwayat.index', compact('surats','riwayat2'));
    }

    /**
     * Unduh PDF Surat Izin Kapal (operasional atau trayek)
     */
    public function cetakPDF($id)
    {
        $surat = Surat::with('user')->findOrFail($id);

        // Cek hak akses: hanya admin atau pemilik Surat
        if (!(auth()->user()->role === 'a' || $surat->user_id === auth()->id())) {
            abort(403, 'Anda tidak memiliki akses ke Surat ini.');
        }

        // Tentukan view berdasarkan jenis perizinan
        $jenisPerizinan = strtolower($surat->jenisperizinan);
        $view = match ($jenisPerizinan) {
            'trayek' => 'riwayat.trayek',
            'izin operasional' => 'riwayat.operasional',
            default => abort(404, 'Jenis perizinan tidak dikenali.')
        };

        // Ambil data pemilik dari relasi user
        $pemilik = $surat->user;

        // Format tanggal dan masa berlaku
        $tanggal = Carbon::parse($surat->updated_at)->translatedFormat('d F Y');
        $berlaku_sampai = Carbon::parse($surat->updated_at)->addYears(5)->translatedFormat('d F Y');

        // Generate PDF dari view yang sesuai
        $pdf = Pdf::loadView($view, compact('surat', 'pemilik', 'tanggal', 'berlaku_sampai'));
        return $pdf->download('surat-izin-surat-' . $surat->nama . '.pdf');
    }

    /**
     * Detail surat untuk user atau admin
     */
    public function show($id)
    {
        $surat = Surat::with('user')->findOrFail($id);
        return view('riwayat.detail', compact('surat'));
    }
        public function cetakPDF2($id)
    {
        $perpanjangsurat = Perpanjangsurat::with(['surat.user'])->findOrFail($id);
        $surat = $perpanjangsurat->surat;

        // Hanya admin atau pemilik data yang bisa akses
        if (!(auth()->user()->role === 'a' || $surat->user_id === auth()->id())) {
            abort(403, 'Anda tidak memiliki akses ke surat ini.');
        }

        $jenisPerizinan = strtolower($surat->jenisperizinan);

        if ($jenisPerizinan === 'trayek') {
            $view = 'riwayat.trayek';
        } elseif ($jenisPerizinan === 'izin operasional') {
            $view = 'riwayat.operasional';
        } else {
            abort(404, 'Jenis perizinan tidak dikenali.');
        }

    $data = [
        'surat' => $surat,
        'perpanjangsurat' => $perpanjangsurat,
        'pemohon' => $surat->user,
        'tanggal' => Carbon::parse($perpanjangsurat->updated_at)->translatedFormat('d F Y'),
        'berlaku_sampai' => Carbon::parse($perpanjangsurat->updated_at)->addYears(5)->translatedFormat('d F Y')
    ];

    $pdf = Pdf::loadView($view, $data);
    return $pdf->download("perpanjangan-{$surat->nama}-{$perpanjangsurat->id}.pdf");
}

    public function show2($id)
    {
        $perpanjangsurat = Perpanjangsurat::with(['surat.user'])->findOrFail($id);
        return view('riwayat.detail2', compact('perpanjangsurat'));
    }
}
