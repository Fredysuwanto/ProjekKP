@extends('layout.main')

@section('title', 'Data Kapal')

@section('content')
<div class="container-fluid">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h4 class="fw-bold mb-3">
        <i class="mdi mdi-ferry text-primary me-1"></i> Data Kapal
      </h4>

      {{-- Alert Perhatian --}}
      <div class="alert alert-warning d-flex align-items-center shadow-sm rounded" role="alert">
        <i class="mdi mdi-alert-circle-outline fs-4 me-2"></i>
        <div>
          <strong>Perhatian:</strong> Mohon periksa kembali setiap entri data kapal. Kesalahan input dapat memengaruhi validitas dokumen perizinan.
        </div>
      </div>

      {{-- Tombol Tambah Kapal --}}
      <a href="{{ route('kapal.create') }}" class="btn btn-primary btn-rounded mb-3">
        <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah Kapal
      </a>

      {{-- Flash Message --}}
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
          <i class="mdi mdi-check-circle-outline me-1"></i> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
          <i class="mdi mdi-alert-outline me-1"></i> {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      {{-- Tabel Data Kapal --}}
      <div class="table-responsive">
        @if ($kapal->isEmpty())
          <div class="alert alert-info text-center shadow-sm">
            <i class="mdi mdi-information-outline me-1"></i> Belum ada data kapal yang terdaftar.
          </div>
        @else
          <table class="table table-bordered text-center align-middle">
            <thead style="background-color: #003974; color: white;">
              <tr>
                <th>No</th>
                <th>Nama Kapal</th>
                <th>No. Plat</th>
                <th>Jenis</th>
                <th>Ukuran</th>
                <th>Tanda Selar</th>
                <th>Daya Mesin</th>
                <th>Muatan</th>
                <th>Jenis Perizinan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kapal as $index => $item)
                @php
                  $sudahDiproses = $item->surats->contains(fn($surat) => $surat->status === 'diproses');
                @endphp
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->noplat }}</td>
                  <td>{{ $item->jenis }}</td>
                  <td>{{ $item->ukuran }}</td>
                  <td>{{ $item->tandaselar }}</td>
                  <td>{{ $item->daya }}</td>
                  <td>{{ $item->muatan }}</td>
                  <td>
                    <span class="badge bg-primary text-white px-2 py-1">
                      {{ $item->jenisperizinan }}
                    </span>
                  </td>
                  <td>
                    @if(!$sudahDiproses)
                      <a href="{{ route('kapal.edit', $item->id) }}" class="btn btn-sm btn-warning rounded-pill">
                        <i class="mdi mdi-pencil me-1"></i> Edit
                      </a>
                    @else
                      <span class="badge bg-secondary px-2 py-1">Terkunci</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
