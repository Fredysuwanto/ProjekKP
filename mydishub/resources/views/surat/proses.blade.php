@extends('layout.main')

@section('title', 'Proses Surat Izin Kapal')

@section('content')
<style>
    .font-times {
        font-family: "Times New Roman", Times, serif;
    }

    .proses-container {
        background-color: #fff;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: "Times New Roman", Times, serif;
    }

    .proses-container h2 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .proses-container .subtitle {
        text-align: center;
        margin-bottom: 30px;
    }

    .proses-container table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .proses-container th, .proses-container td {
        border: 1px solid #000;
        padding: 8px 12px;
        text-align: center;
    }

    .proses-container th {
        background-color: #eaeaea;
    }

    .btn-pdf {
        background-color: #1e40af;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
    }

    .btn-pdf i {
        margin-right: 5px;
    }
</style>

<!-- PROSES SURAT IZIN KAPAL -->
<div class="container proses-container">
    <h2>PROSES SURAT IZIN KAPAL</h2>
    <p class="subtitle">Daftar kapal yang saat ini sedang berjalan</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemilik</th>
                <th>Nama Kapal</th>
                <th>Tanggal Pengajuan</th>
                <th>Masa Berlaku</th>
                <th>File Dokumen</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proses as $index => $surat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $surat->pemilik->nama }}</td>
                <td>{{ $surat->kapal->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($surat->updated_at)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($surat->updated_at)->addYears(5)->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('riwayat.cetak', $surat->id) }}" class="btn-pdf">
                        <i class="mdi mdi-file-download-outline"></i> Unduh PDF
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada surat yang sedang diproses.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PROSES PERPANJANG SURAT IZIN KAPAL -->
<div class="container proses-container">
    <h2>PROSES PERPANJANG SURAT IZIN KAPAL</h2>
    <p class="subtitle">Daftar kapal yang saat ini sedang berjalan</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemilik</th>
                <th>Nama Kapal</th>
                <th>Tanggal Pengajuan</th>
                <th>Masa Berlaku</th>
                <th>Dokumen</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proses2 as $index => $perpanjangsurat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $perpanjangsurat->surat->pemilik->nama }}</td>
                <td>{{ $perpanjangsurat->surat->kapal->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($perpanjangsurat->updated_at)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($perpanjangsurat->updated_at)->addYears(5)->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('riwayat.cetak2', $perpanjangsurat->id) }}" class="btn-pdf">
                        <i class="mdi mdi-file-download-outline"></i> Unduh PDF
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada surat yang sedang diproses.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
