@extends('layout.main')

@section('content')
<div class="container">
    <h1 class="mb-4">Buat Perpanjangan Surat Baru</h1>
        <div class="col-12 mt-2">
        <div class="alert alert-warning shadow-sm">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            <strong>Pastikan memilih surat yang telah kadaluarsa.</strong> Surat yang telah masih aktif tidak dapat diperpanjang. Kesalahan data dapat memilih surat dapat menyebabkan error. Silahkan cek masa surat anda di tabel riwayat
        </div>
    </div>
    <br>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('perpanjangsurat.store') }}">
        @csrf

        <div class="mb-3">
            <label for="riwayat_id" class="form-label">Pilih Surat</label>
<select name="surat_id" class="form-control" required>
    <option value="">-- Pilih Riwayat Surat --</option>
    @foreach($surats as $surat)
        <option value="{{ $surat->id }}">
            {{ $surat->pemilik->nama }} - {{ $surat->kapal->noplat }}
        </option>
    @endforeach
</select>
        </div>
<br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
