@extends('layout.main')

@section('content')
<style>
    .bg-visimisi {
        background-image: url('{{ asset('images/bg-dishub.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        padding: 60px 0;
    }

    .content-wrapper {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0,0,0,0.15);
    }

    .misi-card {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        border-left: 5px solid #0d6efd;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        height: 100%;
    }

    .misi-icon {
        font-size: 1.2rem;
        color: #198754;
        margin-right: 5px;
    }
</style>

<div class="bg-visimisi d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="content-wrapper">

                    <!-- Judul -->
                    <div class="d-flex align-items-center mb-4">
                        <i class="mdi mdi-eye-outline text-primary" style="font-size: 2rem;"></i>
                        <h2 class="ms-2 text-dark fw-bold mb-0">
                            Visi dan Misi Dinas Perhubungan Provinsi Sumatera Selatan
                        </h2>
                    </div>

                    <!-- Visi -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h5 class="text-dark fw-semibold mb-3">
                                <i class="mdi mdi-bullseye-arrow text-primary me-2"></i>Visi
                            </h5>
                            <p class="text-dark fs-6" style="line-height: 1.8;">
                                Mewujudkan sistem transportasi yang aman, tertib, lancar, berkelanjutan, dan berbasis teknologi guna mendukung pembangunan Sumatera Selatan yang maju dan sejahtera.
                            </p>
                        </div>
                    </div>

                    <!-- Misi -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="text-dark fw-semibold mb-4">
                                <i class="mdi mdi-format-list-checks text-primary me-2"></i>Misi
                            </h5>

                            @php
                                $misiList = [
                                    [
                                        'judul' => 'Meningkatkan Infrastruktur Transportasi',
                                        'deskripsi' => 'Mengembangkan dan meningkatkan infrastruktur transportasi darat, laut, dan udara yang modern dan berkualitas.'
                                    ],
                                    [
                                        'judul' => 'Meningkatkan Keselamatan dan Ketertiban Transportasi',
                                        'deskripsi' => 'Meningkatkan keselamatan transportasi dengan penerapan regulasi yang ketat serta edukasi kepada masyarakat.'
                                    ],
                                    [
                                        'judul' => 'Meningkatkan Pelayanan Transportasi Publik',
                                        'deskripsi' => 'Mengembangkan transportasi umum yang nyaman, terjangkau, dan ramah lingkungan untuk meningkatkan mobilitas masyarakat.'
                                    ],
                                    [
                                        'judul' => 'Mendorong Digitalisasi dan Inovasi Transportasi',
                                        'deskripsi' => 'Memanfaatkan teknologi informasi dalam manajemen transportasi untuk menciptakan layanan yang efisien dan transparan.'
                                    ],
                                    [
                                        'judul' => 'Meningkatkan Koordinasi dan Kerjasama',
                                        'deskripsi' => 'Menjalin kerjasama dengan pemerintah daerah, swasta, dan masyarakat dalam perencanaan dan pengelolaan transportasi.'
                                    ],
                                    [
                                        'judul' => 'Meningkatkan Kesadaran Masyarakat',
                                        'deskripsi' => 'Mendorong penggunaan transportasi ramah lingkungan untuk mengurangi polusi dan kemacetan.'
                                    ]
                                ];
                            @endphp

                            <div class="row">
                                @foreach ($misiList as $index => $misi)
                                    <div class="col-md-6 mb-4">
                                        <div class="misi-card">
                                            <h6 class="text-dark fw-bold mb-1">
                                                <i class="mdi mdi-checkbox-marked-circle-outline misi-icon"></i>
                                                {{ $index + 1 }}. {{ $misi['judul'] }}
                                            </h6>
                                            <p class="text-dark mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                                                {{ $misi['deskripsi'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div> <!-- content-wrapper -->
            </div>
        </div>
    </div>
</div>
@endsection
