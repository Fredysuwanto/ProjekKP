@extends('layout.main')

@section('content')
<div class="container p-5 shadow bg-white rounded" style="font-family: 'Times New Roman', Times, serif;">

    <!-- Header Surat -->
    <div class="text-center mb-4">
        <h2 class="fw-bold">LAPORAN SURAT IZIN KAPAL</h2>
        <p><em>Daftar kapal yang telah mengajukan surat izin</em></p>
        <hr style="border: 1px solid black; width: 60%;">
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Utama -->
    <h5 class="fw-bold mb-3">Tabel Data Surat</h5>
    <table class="table table-bordered table-hover" style="font-size: 15px;">
        <thead class="table-dark text-center">
            <tr>
                <th>Nama Pemilik</th>
                <th>Alamat</th>
                <th>Nama Kapal</th>
                <th>No Plat</th>
                <th>Jenis</th>
                <th>Ukuran</th>
                <th>Daya Mesin</th>
                <th>Jenis Perizinan</th>
                <th>Status</th>
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
                    <td class="text-center">
                        @if ($surat->status === null)
                            <span class="badge bg-secondary">Belum Diproses</span>
                        @elseif ($surat->status === 'diproses')
                            <span class="badge bg-success">Diproses</span>
                        @elseif ($surat->status === 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-warning">Tidak Dikenal</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data surat ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tabel Aksi -->
    <h5 class="fw-bold mt-5 mb-3">Tabel Aksi Pemrosesan</h5>
    <table class="table table-bordered table-striped" style="font-size: 15px;">
        <thead class="table-light text-center">
            <tr>
                <th>Nama Pemilik</th>
                <th>Nama Kapal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($surats as $surat)
                @if ($surat->status === null)
                    <tr>
                        <td>{{ $surat->pemilik->nama }}</td>
                        <td>{{ $surat->kapal->nama }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('surat.proses', $surat->id) }}" class="btn btn-sm btn-outline-success">Proses</a>
                                <a href="{{ route('surat.tolak', $surat->id) }}" class="btn btn-sm btn-outline-danger">Tolak</a>
                            </div>
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data surat untuk diproses.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer -->
    <div class="text-end mt-5">
        <p><strong>Palembang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong></p>
        <p class="mt-5"><strong>Petugas Dinas Perhubungan</strong></p>
    </div>
</div>
@endsection
