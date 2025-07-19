@extends('layout.main')

@section('title', 'Detail Kapal')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Detail Kapal</h5>
            <a href="{{ route('riwayat.index') }}" class="btn btn-sm btn-light text-dark">
                <i class="mdi mdi-arrow-left"></i> Kembali
            </a>
        </div>        
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <tbody>
                        <tr>
                            <th style="width: 25%">Nama Pemilik</th>
                            <td>{{ $perpanjangsurat->surat->nama }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kapal</th>
                            <td>{{ $perpanjangsurat->surat->nama }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Plat</th>
                            <td>{{ $perpanjangsurat->surat->noplat }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kapal</th>
                            <td>{{ $perpanjangsurat->surat->jenis }}</td>
                        </tr>
                        <tr>
                            <th>Ukuran</th>
                            <td>{{ $perpanjangsurat->surat->ukuran }}</td>
                        </tr>
                         <tr>
                            <th>Tanda Selar</th>
                            <td>{{ $perpanjangsurat->surat->tandaselar }}</td>
                        </tr>
                        <tr>
                            <th>Daya Mesin</th>
                            <td>{{ $perpanjangsurat->surat->daya }}</td>
                        </tr>
                        <tr>
                            <th>Muatan</th>
                            <td>{{ $perpanjangsurat->surat->muatan }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Perizinan</th>
                            <td>
                                 <span class="badge text-white px-2 py-1" style="background-color: #007bff;">
                                 {{ $perpanjangsurat->surat->jenisperizinan }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <td>{{ \Carbon\Carbon::parse($perpanjangsurat->created_at)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($perpanjangsurat->status === 'diproses')
                                    <span class="badge bg-success">Diproses</span>
                                @elseif ($perpanjangsurat->status === 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">Belum Diproses</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
