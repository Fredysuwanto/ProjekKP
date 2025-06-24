@extends('layout.main')

@section('content')
<div class="container py-5 d-flex flex-column justify-content-center align-items-center text-center" style="min-height: 80vh;">
    <div class="mb-4">
        <i class="mdi mdi-lock-alert text-danger" style="font-size: 5rem;"></i>
    </div>
    <h1 class="display-3 fw-bold text-dark">403</h1>
    <p class="fs-5 text-muted mb-4">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary rounded-pill px-4">
        <i class="mdi mdi-arrow-left me-1"></i> Kembali ke halaman sebelumnya
    </a>
</div>
@endsection
