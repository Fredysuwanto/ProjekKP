@extends('layout.main')

@section('title', 'Data Surat Izin Kapal')

@section('content')
<div class="container-fluid">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h4 class="fw-bold mb-3">
        <i class="mdi mdi-file-document-outline text-primary me-1"></i> Data Surat Izin Kapal
      </h4>
      <p class="text-muted">
        Berikut adalah daftar surat izin kapal yang telah diajukan oleh pemilik kapal. Data ini akan menjadi acuan dalam proses verifikasi dan persetujuan perizinan.
      </p>

      @if(auth()->user()->role === 'b')
        <a href="{{ route('surat.create') }}" class="btn btn-primary btn-rounded mb-3">
          <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah Surat
        </a>
      @endif

      <div class="table-responsive">
        <table class="table align-middle text-center table-bordered">
          <thead style="background-color: #003974; color: white;">
            <tr>
              <th>Nama Pemilik</th>
              <th>Alamat</th>
              <th>Nama Kapal</th>
              <th>No. Plat</th>
              <th>Jenis</th>
              <th>Ukuran</th>
              <th>Tanda Selar</th>
              <th>Daya Mesin</th>
              <th>Jenis Perizinan</th>
              <th>Status</th>
              @if(auth()->user()->role === 'a')
                <th>Aksi</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse($surats as $surat)
            <tr>
              <td>{{ $surat->pemilik->nama }}</td>
              <td>{{ $surat->pemilik->alamat }}</td>
              <td>{{ $surat->kapal->nama }}</td>
              <td>{{ $surat->kapal->noplat }}</td>
              <td>{{ $surat->kapal->jenis }}</td>
              <td>{{ $surat->kapal->ukuran }}</td>
              <td>{{ $surat->kapal->tandaselar }}</td>
              <td>{{ $surat->kapal->daya }}</td>
              <td>
                <span class="badge bg-primary text-white px-3 py-2">
                  {{ $surat->kapal->jenisperizinan }}
                </span>
              </td>
              <td>
                @if ($surat->status === null)
                  <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
                @else
                  <span class="badge bg-info text-white px-3 py-2">{{ ucfirst($surat->status) }}</span>
                @endif
              </td>
              @if(auth()->user()->role === 'a')
              <td>
                @if ($surat->status === null)
                <div class="d-flex justify-content-center gap-2">
                  <a href="{{ route('surat.proses', $surat->id) }}" class="btn btn-success btn-sm rounded-pill px-3">
                    <i class="mdi mdi-check-circle-outline me-1"></i> Proses
                  </a>
                  <a href="{{ route('surat.tolak', $surat->id) }}" class="btn btn-danger btn-sm rounded-pill px-3">
                    <i class="mdi mdi-close-circle-outline me-1"></i> Tolak
                  </a>
                </div>
                @else
                <span class="text-muted">-</span>
                @endif
              </td>
              @endif
            </tr>
            @empty
            <tr>
              <td colspan="{{ auth()->user()->role === 'a' ? '11' : '10' }}" class="text-center text-muted py-4">
                <i class="mdi mdi-information-outline me-1"></i> Tidak ada data surat.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

@if (session('success'))
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    Swal.fire({
      title: "Sukses!",
      text: "{{ session('success') }}",
      icon: "success"
    });
  </script>
@endif
@endsection
