@extends('layout.main')

@section('content')
<div class="container">
    <h3>Daftar Riwayat Surat Izin Kapal</h3>
    <a href="{{ route('riwayat.create') }}" class="btn btn-success mb-3">+ Tambah Riwayat</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>No Surat</th>
                <th>Nomor Plat</th>
                <th>Jenis Perizinan</th>
                <th>File Surat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayats as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r["nosurat"] }}</td>
                <td>{{ $r->kapal->noplat ?? '-' }}</td>
                <td>{{ $r->kapal->jenisperizinan ?? '-' }}</td>
                <td>
                    @if ($r->file_surat)
                        <a href="{{ asset('storage/' . $r->file_surat) }}" target="_blank">Lihat dan Unduh</a>
                    @else
                        Tidak Ada
                    @endif
                </td>
                <td>
                    <a href="{{ route('riwayat.edit', $r->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('riwayat.destroy', $r->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data riwayat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
