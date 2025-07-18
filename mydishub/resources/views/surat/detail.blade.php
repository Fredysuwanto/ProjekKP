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
          <td>{{ $surat->user->name ?? '-' }}</td>
        </tr>
        <tr>
          <th>NIK / NPWP</th>
          <td>{{ $surat->user->pemilik->nik ?? '-' }}</td>
        </tr>
        <tr>
          <th>Alamat Pemilik</th>
          <td>{{ $surat->user->pemilik->alamat ?? '-' }}</td>
        </tr>

        {{-- Status --}}
        <tr>
          <th>Status</th>
          <td>
            @php $status = $surat->status ?? 'menunggu'; @endphp
            @if ($status === 'diproses')
              <span class="badge bg-success text-white px-3 py-2">Diproses</span>
            @elseif ($status === 'ditolak')
              <span class="badge bg-danger text-white px-3 py-2">Ditolak</span>
            @else
              <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
            @endif
          </td>
        </tr>

        {{-- Data surat --}}
        <tr><th>Nama Kapal</th><td>{{ $surat->nama }}</td></tr>
        <tr><th>No. Plat</th><td>{{ $surat->noplat }}</td></tr>
        <tr><th>Jenis</th><td>{{ $surat->jenis }}</td></tr>
        <tr><th>Ukuran</th><td>{{ $surat->ukuran }}</td></tr>
        <tr><th>Tanda Selar</th><td>{{ $surat->tandaselar }}</td></tr>
        <tr><th>Daya Mesin</th><td>{{ $surat->daya }}</td></tr>
        <tr><th>Muatan</th><td>{{ $surat->muatan }}</td></tr>
        <tr><th>Jenis Perizinan</th><td>{{ $surat->jenisperizinan }}</td></tr>

        @if ($surat->jenisperizinan === 'Trayek')
          <tr><th>Tujuan</th><td>{{ $surat->tujuan }}</td></tr>
        @endif

        {{-- File STNK --}}
        <tr>
          <th>File STNK</th>
          <td>
            @if($surat->file_stnk)
              <a href="{{ Storage::url($surat->file_stnk) }}" target="_blank" class="btn btn-sm btn-info">
                <i class="mdi mdi-file-document"></i> Lihat STNK
              </a>
            @else
              <span class="text-muted">Tidak ada file</span>
            @endif
          </td>
        </tr>
      </table>

      <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
@endsection
