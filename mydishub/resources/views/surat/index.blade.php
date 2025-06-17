@extends('layout.main')

@section('content')
<div class="container">
    <h1>Daftar Surat Izin Kapal</h1>
    <a href="{{ route('surat.create') }}" class="btn btn-primary mb-3">Buat Surat</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Pemilik</th>
                <th>Alamat</th>
                <th>Nama Kapal</th>
                <th>No Plat</th>
                <th>Jenis</th>
                <th>Ukuran</th>
                <th>Daya Mesin</th>
                <th>Jenis Perizinan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surats as $surat)
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
                    <a href="{{ route('surat.edit', $surat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('surat.destroy', $surat->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
