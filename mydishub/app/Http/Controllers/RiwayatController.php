<?php
namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Kapal;
use App\Models\Surat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatController extends Controller
{
   public function index()
{
    // Ambil data surat yang sudah diproses saja, misalnya:
    $riwayats = Surat::where('status', 'diproses')->get();

    return view('riwayat.index', compact('riwayats'));
}

    public function cetakPDF($id)
{
    $surat = Surat::findOrFail($id);

    $jenisPerizinan = strtolower($surat->kapal->jenisperizinan); // pastikan lowercase untuk pencocokan aman

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