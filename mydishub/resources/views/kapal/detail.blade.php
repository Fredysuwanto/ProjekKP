@extends('layout.main')

@section('title', 'Detail Kapal')

@section('content')
<div class="col-md-8 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Detail Kapal</h4>

      <table class="table">
        {{-- Informasi Pemilik --}}
        <tr>
          <th>Nama Pemilik</th>
          <td>{{ $kapal->user->name ?? '-' }}</td>
        </tr>
        <tr>
          <th>NIK / NPWP</th>
          <td>{{ $kapal->user->pemilik->nik ?? '-' }}</td>
        </tr>
        <tr>
          <th>Alamat Pemilik</th>
          <td>{{ $kapal->user->pemilik->alamat ?? '-' }}</td>
        </tr>

        {{-- Status --}}
        <tr>
          <th>Status</th>
          <td>
            @php $status = $kapal->status ?? 'menunggu'; @endphp
            @if ($status === 'diproses')
              <span class="badge bg-success text-white px-3 py-2">Diproses</span>
            @elseif ($status === 'ditolak')
              <span class="badge bg-danger text-white px-3 py-2">Ditolak</span>
            @else
              <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
            @endif
          </td>
        </tr>

        {{-- Data Kapal --}}
        <tr><th>Nama Kapal</th><td>{{ $kapal->nama }}</td></tr>
        <tr><th>No. Plat</th><td>{{ $kapal->noplat }}</td></tr>
        <tr><th>Jenis</th><td>{{ $kapal->jenis }}</td></tr>
        <tr><th>Ukuran</th><td>{{ $kapal->ukuran }}</td></tr>
        <tr><th>Tanda Selar</th><td>{{ $kapal->tandaselar }}</td></tr>
        <tr><th>Daya Mesin</th><td>{{ $kapal->daya }}</td></tr>
        <tr><th>Muatan</th><td>{{ $kapal->muatan }}</td></tr>
        <tr><th>Jenis Perizinan</th><td>{{ $kapal->jenisperizinan }}</td></tr>

        @if ($kapal->jenisperizinan === 'Trayek')
          <tr><th>Tujuan</th><td>{{ $kapal->tujuan }}</td></tr>
        @endif

        {{-- File STNK --}}
        <tr>
          <th>File STNK</th>
          <td>
            @if($kapal->file_stnk)
              <a href="{{ Storage::url($kapal->file_stnk) }}" target="_blank" class="btn btn-sm btn-info">
                <i class="mdi mdi-file-document"></i> Lihat STNK
              </a>
            @else
              <span class="text-muted">Tidak ada file</span>
            @endif
          </td>
        </tr>
      </table>

      <a href="{{ route('kapal.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
@endsection
