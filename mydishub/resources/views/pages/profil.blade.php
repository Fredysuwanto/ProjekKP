@extends('layout.main')

@section('title', 'Profil Kami')

@section('content')
<style>
    .background-tentang {
        background-image: url('{{ asset('images/bg-dishub.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        padding: 60px 0;
    }

    .konten-overlay {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .konten-overlay h2 {
        font-weight: 700;
        color: #2b3d82;
    }

    .konten-overlay p, .konten-overlay li {
        font-size: 1rem;
        color: #333;
        line-height: 1.7;
    }

    .konten-overlay ul {
        padding-left: 20px;
    }

    .konten-overlay ul li::before {
        content: "✔️ ";
        color: #0d6efd;
        margin-right: 5px;
    }
</style>

<div class="background-tentang d-flex align-items-center">
    <div class="container">
        <div class="konten-overlay">
            <h2 class="mb-4">
                <i class="mdi mdi-city text-primary me-2"></i>
                Profil Dishub
            </h2>

            <p><strong>Dinas Perhubungan (Dishub) Sumatera Selatan</strong> adalah instansi pemerintah provinsi yang bertanggung jawab atas urusan perhubungan di wilayah Sumatera Selatan. Dishub Sumsel memiliki peran penting dalam menyelenggarakan layanan dan regulasi transportasi yang meliputi sektor <strong>perkeretaapian, pelayaran, dan lalu lintas jalan</strong>.</p>

            <p>Dengan mengedepankan prinsip pelayanan publik yang profesional, Dishub Sumsel terus berupaya menciptakan sistem transportasi yang:</p>

            <ul>
                <li>Aman dan tertib bagi seluruh masyarakat</li>
                <li>Lancar dalam mendukung mobilitas dan aktivitas ekonomi</li>
                <li>Berkelanjutan serta ramah lingkungan</li>
                <li>Berbasis teknologi dan data dalam pengambilan keputusan</li>
            </ul>

            <p>Melalui digitalisasi dan transformasi layanan publik, Dishub Sumsel mendukung pembangunan infrastruktur dan pelayanan transportasi terpadu untuk mewujudkan visi pembangunan Sumatera Selatan yang unggul dan maju.</p>
        </div>
    </div>
</div>
@endsection
