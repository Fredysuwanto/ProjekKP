<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
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
            $kapals = Kapal::with('user')->where('status', 'diproses')->get();
        } else {
            // Pemilik hanya melihat kapalnya sendiri
            $kapals = Kapal::with('user')
                        ->where('status', 'diproses')
                        ->where('user_id', auth()->id())
                        ->get();
        }

        return view('riwayat.index', compact('kapals'));
    }

    /**
     * Unduh PDF Surat Izin Kapal (operasional atau trayek)
     */
    public function cetakPDF($id)
    {
        $kapal = Kapal::with('user')->findOrFail($id);

        // Cek hak akses: hanya admin atau pemilik kapal
        if (!(auth()->user()->role === 'a' || $kapal->user_id === auth()->id())) {
            abort(403, 'Anda tidak memiliki akses ke kapal ini.');
        }

        // Tentukan view berdasarkan jenis perizinan
        $jenisPerizinan = strtolower($kapal->jenisperizinan);
        $view = match ($jenisPerizinan) {
            'trayek' => 'riwayat.trayek',
            'izin operasional' => 'riwayat.operasional',
            default => abort(404, 'Jenis perizinan tidak dikenali.')
        };

        // Ambil data pemilik dari relasi user
        $pemilik = $kapal->user;

        // Format tanggal dan masa berlaku
        $tanggal = Carbon::parse($kapal->updated_at)->translatedFormat('d F Y');
        $berlaku_sampai = Carbon::parse($kapal->updated_at)->addYears(5)->translatedFormat('d F Y');

        // Generate PDF dari view yang sesuai
        $pdf = Pdf::loadView($view, compact('kapal', 'pemilik', 'tanggal', 'berlaku_sampai'));
        return $pdf->download('surat-izin-kapal-' . $kapal->nama . '.pdf');
    }

    /**
     * Detail kapal untuk user atau admin
     */
    public function show($id)
    {
        $kapal = Kapal::with('user')->findOrFail($id);
        return view('riwayat.detail', compact('kapal'));
    }
}
