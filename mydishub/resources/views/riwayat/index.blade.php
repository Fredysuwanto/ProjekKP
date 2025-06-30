@extends('layout.main')

@section('title', 'Riwayat Surat Izin Kapal')

@section('content')
<div class="container-fluid">
    <div class="card shadow border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-2">
                <i class="mdi mdi-file-document-outline text-primary me-1"></i>
                Riwayat Surat Izin Kapal
            </h4>
            <p class="text-muted mb-4">
                Berikut adalah daftar pengajuan surat izin kapal yang telah dilakukan.
                <span class="text-primary fw-semibold">Pastikan setiap dokumen diunduh dan disimpan sebagai arsip penting.</span>
            </p>
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead style="background-color: #003974; color: white;">
                        <tr class="align-middle">
                            <th>No.</th>
                            <th>Nama Kapal</th>
                            <th>Jenis Perizinan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Detail</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $index => $surat)
                            @php
                                $jenis = $surat->kapal->jenisperizinan;
                                $badgeColor = $jenis === 'Izin Operasional' ? 'primary' : 'info';
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-medium">{{ $surat->kapal->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $badgeColor }} text-white px-3 py-2 rounded-pill shadow-sm">
                                        {{ $jenis }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($surat->updated_at)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('riwayat.detail', $surat->id) }}" 
                                       class="btn btn-outline-info btn-sm rounded-pill shadow-sm">
                                        <i class="mdi mdi-eye-outline me-1"></i> Detail
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('riwayat.cetak', $surat->id) }}" 
                                       class="btn btn-sm text-white fw-semibold rounded-pill shadow-sm" 
                                       style="background-color: #1e40af;">
                                        <i class="mdi mdi-file-download-outline me-1"></i> Unduh PDF
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="mdi mdi-information-outline fs-4 me-2"></i>
                                    Belum ada data surat izin yang diproses.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card shadow border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-2">
                <i class="mdi mdi-file-document-outline text-primary me-1"></i>
                Riwayat Perpanjang Surat Izin Kapal
            </h4>
            <p class="text-muted mb-4">
                Berikut adalah daftar pengajuan perpanjang surat izin kapal yang telah dilakukan.
                <span class="text-primary fw-semibold">Pastikan setiap dokumen diunduh dan disimpan sebagai arsip penting.</span>
            </p>
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead style="background-color: #003974; color: white;">
                        <tr class="align-middle">
                            <th>No.</th>
                            <th>Nama Kapal</th>
                            <th>Jenis Perizinan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Detail</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat2 as $index => $perpanjangsurat)
                            @php
                                $jenis = $perpanjangsurat->surat->kapal->jenisperizinan;
                                $badgeColor = $jenis === 'Izin Operasional' ? 'primary' : 'info';
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-medium">{{ $perpanjangsurat->surat->kapal->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $badgeColor }} text-white px-3 py-2 rounded-pill shadow-sm">
                                        {{ $jenis }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($surat->updated_at)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('riwayat.detail2', $surat->id) }}" 
                                       class="btn btn-outline-info btn-sm rounded-pill shadow-sm">
                                        <i class="mdi mdi-eye-outline me-1"></i> Detail
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('riwayat.cetak2', $surat->id) }}" 
                                       class="btn btn-sm text-white fw-semibold rounded-pill shadow-sm" 
                                       style="background-color: #1e40af;">
                                        <i class="mdi mdi-file-download-outline me-1"></i> Unduh PDF
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="mdi mdi-information-outline fs-4 me-2"></i>
                                    Belum ada data surat izin yang diproses.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
