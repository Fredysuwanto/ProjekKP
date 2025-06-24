@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    {{-- Header Selamat Datang --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-3 p-4 bg-light mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="mdi mdi-account-circle text-primary" style="font-size: 2.5rem;"></i>
                    <div class="ms-3">
                        <h3 class="mb-1 fw-bold">Selamat Datang, {{ auth()->user()->name }} 👋</h3>
                        <p class="text-muted mb-0">
                            @if(auth()->user()->role === 'a')
                                Anda login sebagai <strong>Admin</strong>. Silakan cek menu <em>Laporan</em> dan <em>Proses</em>.
                            @elseif(auth()->user()->role === 'b')
                                Anda login sebagai <strong>Pemilik</strong>. Silakan kelola <em>Data Kapal</em>, <em>Surat</em>, dan <em>Riwayat</em>.
                            @endif
                        </p>
                    </div>
                </div>

                <hr class="my-3">

                <div class="alert alert-info mb-0">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Gunakan menu navigasi di samping kiri untuk mengakses fitur aplikasi Dishub.
                </div>
            </div>
        </div>
    </div>

    {{-- Banner Warning --}}
    <div class="alert alert-danger d-flex align-items-center mb-4 shadow-sm" role="alert">
        <i class="mdi mdi-alert-circle-outline me-3 fs-3"></i>
        <div>
            <strong>PERINGATAN!</strong> Hati-hati terhadap penipuan yang mengatasnamakan Dishub. Jangan mentransfer dana kepada pihak yang tidak dikenal.
        </div>
    </div>

    {{-- Daftar Berita --}}
    <div class="row">
        @php
            $berita = [
                [
                    'judul' => 'Peringatan Cuaca Ekstrem untuk Wilayah Sungai Musi',
                    'tanggal' => '2025-06-24',
                    'isi' => 'BMKG mengeluarkan peringatan dini terkait gelombang tinggi di wilayah perairan Sungai Musi. Harap berhati-hati bagi pemilik kapal.',
                    'gambar' => 'https://cdn-icons-png.flaticon.com/512/3845/3845731.png'
                ],
                [
                    'judul' => 'Digitalisasi Surat Izin Berlayar',
                    'tanggal' => '2025-06-20',
                    'isi' => 'Dishub meluncurkan sistem e-Surat Izin Berlayar untuk mempercepat proses administrasi dan transparansi layanan.',
                    'gambar' => 'https://cdn-icons-png.flaticon.com/512/2920/2920322.png'
                ],
                [
                    'judul' => 'Update Jadwal Pemeriksaan Kapal',
                    'tanggal' => '2025-06-18',
                    'isi' => 'Pemeriksaan kapal akan dilakukan pada tanggal 27-28 Juni 2025. Pastikan dokumen lengkap dan peralatan standar tersedia.',
                    'gambar' => 'https://cdn-icons-png.flaticon.com/512/3081/3081559.png'
                ],
                [
                    'judul' => 'Peringatan Keamanan Data',
                    'tanggal' => '2025-06-15',
                    'isi' => 'Dishub mengimbau untuk tidak membagikan akun login Anda. Ganti password secara berkala.',
                    'gambar' => 'https://cdn-icons-png.flaticon.com/512/3515/3515455.png'
                ],
                [
                    'judul' => 'Sosialisasi Digitalisasi Pelayanan',
                    'tanggal' => '2025-06-10',
                    'isi' => 'Akan diadakan sosialisasi sistem pelayanan berbasis online bagi seluruh stakeholder transportasi.',
                    'gambar' => 'https://cdn-icons-png.flaticon.com/512/2921/2921222.png'
                ],
                [
                    'judul' => 'Pembaruan Sistem Dishub',
                    'tanggal' => '2025-06-08',
                    'isi' => 'Dishub melakukan pembaruan sistem untuk peningkatan keamanan dan kecepatan layanan.',
                    'gambar' => 'https://cdn-icons-png.flaticon.com/512/833/833472.png'
                ]
            ];
        @endphp

        @foreach ($berita as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="row g-0">
                    <div class="col-4 d-flex align-items-center justify-content-center p-3">
                        <img src="{{ $item['gambar'] }}" alt="Gambar Berita" class="img-fluid rounded" style="max-height: 80px;">
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h6 class="text-primary fw-bold">{{ $item['judul'] }}</h6>
                            <p class="text-muted small mb-1">
                                <i class="mdi mdi-calendar-clock me-1"></i>
                                {{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y') }}
                            </p>
                            <p class="text-dark small">{{ $item['isi'] }}</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
