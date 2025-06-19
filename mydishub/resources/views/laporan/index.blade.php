@extends('layout.main')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Surat Izin Kapal</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nama Pemilik</th>
                <th>Alamat</th>
                <th>Nama Kapal</th>
                <th>No Plat</th>
                <th>Jenis</th>
                <th>Ukuran</th>
                <th>Daya Mesin</th>
                <th>Jenis Perizinan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($surats as $surat)
                <tr>
                    <td>{{ $surat->pemilik->nama }}</td>
                    <td>{{ $surat->pemilik->alamat }}</td>
                    <td>{{ $surat->kapal->nama }}</td>
                    <td>{{ $surat->kapal->noplat }}</td>
                    <td>{{ $surat->kapal->jenis }}</td>
                    <td>{{ $surat->kapal->ukuran }}</td>
                    <td>{{ $surat->kapal->daya }}</td>
                    <td>{{ $surat->kapal->jenisperizinan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data surat ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
