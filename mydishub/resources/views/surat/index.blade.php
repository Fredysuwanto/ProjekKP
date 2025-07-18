@extends('layout.main')

@section('title', 'Data Perizinan')

@section('content')
<div class="container-fluid">
  <div class="card shadow-sm border-0">
    <div class="card-body">
     <h4 class="fw-bold mb-3">
  <i class="mdi mdi-file-document-outline text-primary me-1"></i> Surat Izin
</h4>

      {{-- Alert perhatian --}}
      <div class="alert alert-warning d-flex align-items-center shadow-sm rounded" role="alert">
        <i class="mdi mdi-alert-circle-outline fs-4 me-2"></i>
        <div><strong>Perhatian:</strong> Pastikan data pemilik dan data kapal valid sebelum digunakan untuk perizinan.</div>
      </div>

      {{-- Tombol tambah --}}
      <a href="{{ route('surat.create') }}" class="btn btn-primary btn-rounded mb-3">
        <i class="mdi mdi-plus-circle-outline me-1"></i> Daftar Izin
      </a>

      {{-- Flash message --}}
      @foreach (['success' => 'check-circle', 'error' => 'alert'] as $type => $icon)
        @if (session($type))
          <div class="alert alert-{{ $type == 'success' ? 'success' : 'danger' }} alert-dismissible fade show shadow-sm" role="alert">
            <i class="mdi mdi-{{ $icon }}-outline me-1"></i> {{ session($type) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      @endforeach

      {{-- Tabel --}}
      <div class="table-responsive">
        @if ($surat->isEmpty())
          <div class="alert alert-info text-center shadow-sm">
            <i class="mdi mdi-information-outline me-1"></i> Belum ada data kapal.
          </div>
        @else
          <table class="table table-bordered text-center align-middle">
            <thead style="background:#003974;color:#fff">
              <tr>
                <th>No</th>
                <th>Nama Pemilik</th>
                <th>Nama Kapal</th>
                <th>Plat</th>
                <th>Izin</th>
                <th>Status</th>
                <th>STNK Kapal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($surat as $i => $item)
                @php
                  $status = $item->status ?? 'menunggu';
                  $terkunci = $status === 'diproses';
                @endphp
                <tr>
                  <td>{{ $i + 1 }}</td>
                  
                  <td>{{ $item->user->name ?? '-' }}</td>

                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->noplat }}</td>
                  <td>
                    @if($item->jenisperizinan === 'Trayek')
                      <span class="badge rounded-pill bg-info text-white px-3 py-2">{{ $item->jenisperizinan }}</span>
                    @elseif($item->jenisperizinan === 'Izin Operasional')
                      <span class="badge rounded-pill text-white px-3 py-2" style="background-color: #6f42c1;">{{ $item->jenisperizinan }}</span>
                    @else
                      <span class="badge bg-secondary text-white rounded-pill px-3 py-2">{{ $item->jenisperizinan }}</span>
                    @endif
                  </td>
                  <td>
                    @if ($status === 'diproses')
                      <span class="badge bg-success text-white rounded-pill px-3 py-2">Diproses</span>
                    @elseif ($status === 'ditolak')
                      <span class="badge bg-danger text-white rounded-pill px-3 py-2">Ditolak</span>
                    @else
                      <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Menunggu</span>
                    @endif
                  </td>
                  <td>
                    @if($item->file_stnk)
                      <a href="{{ Storage::url($item->file_stnk) }}" target="_blank" class="btn btn-sm btn-info">
                        <i class="mdi mdi-file-document"></i> Lihat STNK
                      </a>
                    @else
                      <span class="text-muted">Tidak ada file</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('surat.show', $item->id) }}" class="btn btn-info btn-sm rounded-pill" title="Lihat Detail">
                      <i class="mdi mdi-eye"></i> Detail
                    </a>
                    @if(!$terkunci)
                      <a href="{{ route('surat.edit', $item->id) }}" class="btn btn-warning btn-sm rounded-pill" title="Edit">
                        <i class="mdi mdi-pencil"></i>
                      </a>
                    @else
                       <button class="btn btn-secondary btn-sm rounded-circle" title="Terkunci" disabled>
      <i class="mdi mdi-lock"></i>
    </button>
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
