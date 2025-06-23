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
                            <th>Nama Pemilik</th>
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
                            <td>
                                <span class="badge bg-primary text-white px-2 py-1">
                                    {{ $surat->kapal->jenisperizinan }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($surat->updated_at)->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('riwayat.cetak', $surat->id) }}" 
                                   class="btn btn-sm text-white fw-semibold"
                                   style="background-color: #007bff; border: none;">
                                    <i class="mdi mdi-file-download-outline me-1"></i> Unduh PDF
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
