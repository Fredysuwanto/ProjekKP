@extends('layout.main')

@section('title', 'Riwayat Surat Izin Kapal')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="fw-bold mb-3">Riwayat Surat Izin Kapal</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Nama Kapal</th>
                            <th>Jenis Perizinan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $surat)
                        <tr>
                            <td>{{ $surat->pemilik->nama }}</td>
                            <td>{{ $surat->kapal->nama }}</td>
                            <td>{{ $surat->kapal->jenisperizinan }}</td>
                            <td>{{ \Carbon\Carbon::parse($surat->updated_at)->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('riwayat.cetak', $surat->id) }}" class="btn btn-sm btn-purple text-white px-3 py-1" style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); border: none;">
                                    Unduh PDF
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data surat yang diproses.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
