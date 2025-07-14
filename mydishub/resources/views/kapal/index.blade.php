@extends('layout.main')

@section('title', 'Data Kapal')

@section('content')
<div class="container-fluid">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h4 class="fw-bold mb-3">
        <i class="mdi mdi-ferry text-primary me-1"></i> Data Kapal
      </h4>

      {{-- Alert perhatian --}}
      <div class="alert alert-warning d-flex align-items-center shadow-sm rounded" role="alert">
        <i class="mdi mdi-alert-circle-outline fs-4 me-2"></i>
        <div><strong>Perhatian:</strong> Pastikan data kapal valid sebelum digunakan untuk perizinan.</div>
      </div>

      {{-- Tombol tambah --}}
      <a href="{{ route('kapal.create') }}" class="btn btn-primary btn-rounded mb-3">
        <i class="mdi mdi-plus-circle-outline me-1"></i> Tambah Kapal
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
        @if ($kapal->isEmpty())
          <div class="alert alert-info text-center shadow-sm">
            <i class="mdi mdi-information-outline me-1"></i> Belum ada data kapal.
          </div>
        @else
          <table class="table table-bordered text-center align-middle">
            <thead style="background:#003974;color:#fff">
              <tr>
                <th>No</th>
                <th>Nama Kapal</th>
                <th>Plat</th>
                <th>Jenis</th>
                <th>Izin</th>
                <th>Tujuan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kapal as $i => $item)
                @php
                  $terkunci = $item->surats->contains(fn($s) => $s->status === 'diproses');
                @endphp
                <tr>
                  <td>{{ $i + 1 }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->noplat }}</td>
                  <td>{{ $item->jenis }}</td>
                  <td>
  @if($item->jenisperizinan === 'Trayek')
    <span class="badge rounded-pill bg-info text-white px-3 py-2">
      {{ $item->jenisperizinan }}
    </span>
  @elseif($item->jenisperizinan === 'Izin Operasional')
    <span class="badge rounded-pill text-white px-3 py-2" style="background-color: #6f42c1;">
      {{ $item->jenisperizinan }}
    </span>
  @else
    <span class="badge bg-secondary text-white rounded-pill px-3 py-2">
      {{ $item->jenisperizinan }}
    </span>
  @endif
</td>

                  <td>
                    @if($item->jenisperizinan === 'Trayek')
                      {{ $item->tujuan ?? '-' }}
                    @else
                      <span class="text-muted">—</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('kapal.show', $item->id) }}" class="btn btn-info btn-sm rounded-pill" title="Lihat Detail">
                      <i class="mdi mdi-eye"></i> Detail
                    </a>
                    @if(!$terkunci)
                      <a href="{{ route('kapal.edit', $item->id) }}" class="btn btn-warning btn-sm rounded-pill" title="Edit">
                        <i class="mdi mdi-pencil"></i>
                      </a>
                    @else
                      <span class="badge bg-secondary">Terkunci</span>
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
