@extends('layout.main')

@section('title', 'Detail Kapal')

@section('content')
<div class="col-md-8 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Detail Kapal</h4>

      <table class="table">
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
      </table>

      <a href="{{ route('kapal.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
@endsection
