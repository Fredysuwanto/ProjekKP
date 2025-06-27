@extends('layout.main')

@section('title', 'Perpanjang Data Surat Izin Kapal')

@section('content')
<div class="container-fluid">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h4 class="fw-bold mb-3">
        <i class="mdi mdi-file-document-outline text-primary me-1"></i> Data Surat Perpanjang Kapal
      </h4>
      <p class="text-muted">
        Berikut adalah daftar perpanjangan surat izin kapal yang telah diajukan oleh pemilik kapal. 
         <span class="text-primary fw-semibold">Data ini akan menjadi acuan dalam proses verifikasi dan persetujuan perizinan.</span>
      </p>

      @if(auth()->user()->role === 'b')
        <a href="{{ route('perpanjangsurat.create') }}" class="btn btn-primary btn-rounded mb-3">
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
            @forelse($perpanjang as $r)
<tr>
  <td>{{ $r->surat->pemilik->nama }}</td>
  <td>{{ $r->surat->pemilik->alamat }}</td>
  <td>{{ $r->surat->kapal->nama }}</td>
  <td>{{ $r->surat->kapal->noplat }}</td>
  <td>{{ $r->surat->kapal->jenis }}</td>
  <td>{{ $r->surat->kapal->ukuran }}</td>
  <td>{{ $r->surat->kapal->tandaselar }}</td>
  <td>{{ $r->surat->kapal->daya }}</td>
  <td>
                <span class="badge bg-primary text-white px-3 py-2">
                  {{ $r->surat->kapal->jenisperizinan }}
                </span>
              </td>
              <td>
                @if ($r->status === null)
                  <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
                @else
                  <span class="badge bg-info text-white px-3 py-2">{{ ucfirst($r->status) }}</span>
                @endif
              </td>
              @if(auth()->user()->role === 'a')
              <td>
                @if ($r->status === null)
                <div class="d-flex justify-content-center gap-2">
                  <a href="{{ route('perpanjangsurat.proses', $r->id) }}" class="btn btn-success btn-sm rounded-pill px-3">
                    <i class="mdi mdi-check-circle-outline me-1"></i> Proses
                  </a>
                  <a href="{{ route('perpanjangsurat.tolak', $r->id) }}" class="btn btn-danger btn-sm rounded-pill px-3">
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
