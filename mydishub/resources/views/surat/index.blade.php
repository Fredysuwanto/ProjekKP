@extends('layout.main')

@section('title', 'Data Surat Izin Kapal')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Data Surat Izin Kapal</h4>
      <p class="card-description">Daftar Surat yang Telah Diajukan</p>

      <a href="{{ route('surat.create') }}" class="btn btn-rounded btn-primary mb-3" style="background-color: #6f42c1; border-color: #6f42c1;">
        Tambah Surat
      </a>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
          <thead class="thead-dark">
            <tr>
              <th>Nama Pemilik</th>
              <th>Alamat</th>
              <th>Nama Kapal</th>
              <th>No. Plat</th>
              <th>Jenis</th>
              <th>Ukuran</th>
              <th>Daya Mesin</th>
              <th>Jenis Perizinan</th>
              <th>Status</th>
              <th>Aksi</th>
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
              <td>{{ $surat->kapal->daya }}</td>
              <td>{{ $surat->kapal->jenisperizinan }}</td>
              <td>
                @if ($surat->status === null)
                  <span class="badge bg-warning text-dark">Menunggu</span>
                @else
                  <span class="badge bg-info text-white">{{ ucfirst($surat->status) }}</span>
                @endif
              </td>
              <td>
                @if ($surat->status === null)
                <div class="d-flex justify-content-center gap-2">
                  <a href="{{ route('surat.proses', $surat->id) }}" class="btn btn-success btn-sm px-3">Proses</a>
                  <a href="{{ route('surat.tolak', $surat->id) }}" class="btn btn-danger btn-sm px-3">Tolak</a>
                </div>
                @else
                <span class="text-muted">-</span>
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="10" class="text-center">Tidak ada data surat.</td>
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
