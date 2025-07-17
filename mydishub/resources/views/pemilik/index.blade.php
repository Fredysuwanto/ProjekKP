@extends('layout.main')

@section('title', 'Data Pemilik Kapal')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">

      <h4 class="fw-bold mb-3">
        <i class="mdi mdi-account-multiple text-primary me-2"></i> Data Pemilik Kapal
      </h4>
<div class="alert alert-warning d-flex align-items-center" style="background-color: #fff8e1; border: 1px solid #ffe082;">
  <i class="mdi mdi-alert-circle-outline text-warning me-2" style="font-size: 1.5rem;"></i>
  <div>
    <strong>Perhatian:</strong> Pastikan semua data diisi dengan <strong>benar</strong> dan <strong>valid</strong>. Kesalahan data dapat menyebabkan <u>pengajuan izin kapal tertunda atau ditolak</u>.
  </div>
</div>

      {{-- FLASH MESSAGE --}}
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      {{-- Tombol Input --}}
      <a href="{{ route('pemilik.create') }}" class="btn btn-primary btn-rounded mb-4">
        <i class="mdi mdi-plus-circle-outline me-1"></i> Input
      </a>

      {{-- Tabel atau Pesan Kosong --}}
      <div class="table-responsive">
        @if ($pemilik->isEmpty())
          <div class="alert alert-info text-center">
            Belum ada data pemilik kapal yang terdaftar.
          </div>
        @else
          @foreach ($pemilik as $item)
            <table class="table table-bordered mb-4">
              <tr>
                <th style="width: 30%">Data Diri / Perusahaan</th>
                <td>{{ $item->nama }}</td>
              </tr>
              <tr>
                <th>NIK / NPWP</th>
                <td>{{ $item->nik }}</td>
              </tr>
              <tr>
                <th>Alamat</th>
                <td>{{ $item->alamat }}</td>
              </tr>
              <tr>
                <th>Telepon</th>
                <td>{{ $item->telepon }}</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>{{ $item->email }}</td>
              </tr>
              <tr>
    <th>File KTP</th>
    <td>
        @if($item->file_ktp)
            <a href="{{ Storage::url($item->file_ktp) }}" target="_blank" class="btn btn-sm btn-info">
                <i class="mdi mdi-file-document"></i> Lihat Dokumen
            </a>
        @else
            <span class="text-muted">Tidak ada file</span>
        @endif
    </td>
</tr>
              <tr>
                <td colspan="2" class="text-center">
                  <a href="{{ route('pemilik.edit', $item->id) }}" class="btn btn-sm btn-warning">
                    <i class="mdi mdi-pencil"></i> Edit
                  </a>
                </td>
              </tr>
            </table>
          @endforeach
        @endif
      </div>

    </div>
  </div>
</div>
@endsection
