@extends('layout.main')

@section('title', 'Kontak Kami')

@section('content')
<style>
    .bg-kontak {
        background-image: url('{{ asset('images/bg-dishub.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        padding: 60px 0;
    }

    .kontak-wrapper {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
</style>

<div class="bg-kontak d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="kontak-wrapper">

                    <!-- Header -->
                    <div class="d-flex align-items-center mb-4">
                        <i class="mdi mdi-phone-classic text-primary" style="font-size: 2rem;"></i>
                        <h2 class="ms-2 text-dark fw-bold mb-0">Kontak Kami</h2>
                    </div>

                    <div class="row g-4">

                        <!-- Informasi Kontak -->
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body">
                                    <span class="badge bg-primary mb-2">Informasi Dinas</span>

                                    <h5 class="text-dark fw-semibold mb-3">
                                        <i class="mdi mdi-map-marker text-danger me-2"></i>Alamat
                                    </h5>
                                    <p class="text-dark" style="line-height: 1.7;">
                                        Jalan Kapten A. Rivai No. 51, Sungai Pangeran,<br>
                                        Ilir Timur I, Kota Palembang, Sumatera Selatan 30127, Indonesia
                                    </p>

                                    <h5 class="text-dark fw-semibold mt-4 mb-3">
                                        <i class="mdi mdi-phone text-success me-2"></i>Telepon
                                    </h5>
                                    <p class="text-dark mb-0" style="line-height: 1.6;">
                                        (0711) 352005 – 363125<br>
                                        (0711) 377170
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Formulir Kontak -->
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body">
                                    <span class="badge bg-primary mb-2">Formulir Kontak</span>

                                    <form>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label text-dark">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama Anda">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label text-dark">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="nama@email.com">
                                        </div>

                                        <div class="mb-3">
                                            <label for="pesan" class="form-label text-dark">Pesan</label>
                                            <textarea class="form-control" id="pesan" rows="4" placeholder="Tulis pesan Anda..."></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="mdi mdi-send me-1"></i> Kirim Pesan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div> <!-- /.row -->
                </div> <!-- /.kontak-wrapper -->
            </div>
        </div>
    </div>
</div>
@endsection
