@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="card shadow-sm border-0 rounded-3 p-4 bg-light mb-4">
    <h4 class="fw-bold mb-3 text-primary">
        <h3 class="mb-1 fw-bold">Selamat Datang, {{ auth()->user()->name }} 👋</h3>
            <p class="text-muted mb-0">
                @if(auth()->user()->role === 'a')
                    Anda login sebagai <strong>Admin</strong>. Silakan cek menu <em>Laporan</em> dan <em>Proses</em>.
                @elseif(auth()->user()->role === 'b')
                    Anda login sebagai <strong>Pemilik</strong>. Silakan kelola <em>Data Kapal</em>, <em>Surat</em>, dan <em>Riwayat</em>.
                @endif
            </p>
    </h4>
    <hr class="my-3">
        <div class="alert alert-info mb-0">
            <i class="mdi mdi-information-outline me-2"></i>
            Gunakan menu navigasi di samping kiri untuk mengakses fitur aplikasi Dishub.
        </div>
{{-- Tata Cara Pengajuan dan Perpanjangan Surat --}}
<div class="row mt-4">
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="fw-bold text-primary mb-3">
                    <i class="mdi mdi-file-document-edit-outline me-2"></i> Tata Cara Membuat Surat Izin
                </h5>
                <ol class="mb-0">
                    <li>Login ke website <strong>MyDishub</strong></li>
                    <li>Masukkan data diri/data perusahaan Anda</li>
                    <li>Masukkan data kapal yang akan didaftarkan</li>
                    <li>Buat surat dengan memilih kapal yang telah didaftarkan tadi</li>
                    <li>Tunggu 1–2 hari selama hari kerja</li>
                    <li>Hasil surat bisa diunduh dalam bentuk PDF di menu <strong>Riwayat</strong></li>
                </ol>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="fw-bold text-success mb-3">
                    <i class="mdi mdi-refresh-circle me-2"></i> Tata Cara Perpanjang Surat Izin
                </h5>
                <p class="text-danger"><strong>Jika masa surat Anda telah melewati 5 tahun, Anda bisa melakukan perpanjangan melalui website MyDishub.</strong></p>
                <ol class="mb-0">
                    <li>Klik menu <strong>Perpanjang Surat</strong></li>
                    <li>Pilih surat yang telah habis masa berlakunya</li>
                    <li>Tunggu 1–2 hari selama hari kerja</li>
                    <li>Hasil surat bisa diunduh dalam bentuk PDF di menu <strong>Riwayat</strong></li>
                </ol>
            </div>
        </div>
    </div>
</div>
    <div class="col-12 mt-2">
        <div class="alert alert-warning shadow-sm">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            <strong>Pastikan semua data diisi dengan benar dan valid.</strong> Kesalahan data dapat menyebabkan pengajuan izin kapal tertunda atau ditolak, serta dapat memengaruhi validitas dokumen perizinan.
        </div>
    </div>
</div>
@php
    use App\Models\Kapal;

    $totalKapal = auth()->check() && auth()->user()->role === 'b'
        ? Kapal::where('user_id', auth()->id())->count()
        : Kapal::count();
@endphp

<div class="row mb-4">
    <div class="col-md-3 mb-2">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold">Total Kapal</h6>
                <h3>{{ $totalKapal ?? 0 }}</h3>
            </div>
        </div>
    </div>
    <!-- Tambahkan card lainnya untuk Surat Aktif, Riwayat, dll -->
</div>
@endsection
