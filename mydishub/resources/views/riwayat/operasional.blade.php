<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Persetujuan Pengoperasian Kapal</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 30px;
        }
        .text-center { text-align: center; }
        .mt-4 { margin-top: 1.5rem; }
        .mt-2 { margin-top: 0.75rem; }
        .mb-2 { margin-bottom: 0.75rem; }
        .signature { margin-top: 60px; text-align: right; }
        table td { vertical-align: top; padding: 4px 0; }
    </style>
</head>
<body>

    <h2 class="text-center">SURAT PERSETUJUAN PENGOPERASIAN</h2>
    <h3 class="text-center">KAPAL SUNGAI DAN DANAU</h3>

    @php
        $lastId = $kapal->id ?? 1;
        $nomor = '551.31/' . str_pad($lastId, 4, '0', STR_PAD_LEFT) . '/4/Dishub-25';
        $pemilik = $kapal->user;
        $dataPemilik = $pemilik->pemilik ?? null;
    @endphp

    <p class="text-center mt-2">Nomor : {{ $nomor }}</p>

    <p>
        Berdasarkan Surat Permohonan Penerbitan Persetujuan Pengoperasian Kapal Sungai dan Danau Perorangan:
        <u>{{ $pemilik->name ?? '................' }}</u>
        Nomor: <u>-</u>, diberikan Persetujuan Pengoperasian Kapal Sungai dan Danau kepada:
    </p>

    <table style="margin-top: 10px;">
        <tr>
            <td style="width: 250px;">NAMA KAPAL</td>
            <td>: {{ strtoupper($kapal->jenis ?? '') }} “{{ $kapal->nama ?? '...................' }}”</td>
        </tr>
        <tr>
            <td>UKURAN</td>
            <td>: {{ $kapal->ukuran ?? '..,.. X ..,.. X ..,.. M' }}</td>
        </tr>
        <tr>
            <td>TANDA SELAR / NO. PLAT</td>
            <td>: {{ $kapal->tandaselar ?? 'GT. .... NO. ......' }}</td>
        </tr>
        <tr>
            <td>DI PERAIRAN SUNGAI DAN DANAU</td>
            <td>: SUMATERA SELATAN</td>
        </tr>
        <tr>
            <td>ALAMAT PEMILIK / PENANGGUNG JAWAB</td>
            <td>: {{ $dataPemilik->alamat ?? '.......................................................' }}</td>
        </tr>
        <tr>
            <td>NPWP / KTP</td>
            <td>: {{ $dataPemilik->nik ?? '.......................................................' }}</td>
        </tr>
    </table>

    <p class="mt-4"><strong>KEWAJIBAN PEMEGANG (SPPKSD):</strong></p>
    <ol>
        <li>Memiliki izin yang sah.</li>
        <li>Mengoperasikan kapal yang memenuhi persyaratan keselamatan (laik laut).</li>
        <li>Memulai kegiatan nyata maksimal 1 bulan setelah terbit.</li>
        <li>Gunakan dermaga resmi yang ditetapkan oleh pihak berwenang.</li>
        <li>Hindari pencemaran lingkungan.</li>
        <li>Laporkan kegiatan ke Dishub Sumsel secara berkala.</li>
    </ol>

    <p>
        Surat Persetujuan ini dapat ditinjau kembali atau dicabut apabila pemegang tidak mematuhi ketentuan atau melakukan tindak pidana.
    </p>

    <p>
        Surat ini berlaku selama 5 (lima) tahun sejak tanggal dikeluarkan sampai dengan tanggal
        <u>{{ $berlaku_sampai ?? '.....................' }}</u>
    </p>

    <table class="mt-4" style="width: 100%;">
        <tr>
            <td style="width: 50%;"></td>
            <td>
                Dikeluarkan di: Palembang<br>
                Pada Tanggal : {{ $tanggal ?? \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </td>
        </tr>
    </table>

    <div class="signature">
        <p>KEPALA DINAS PERHUBUNGAN<br>PROVINSI SUMATERA SELATAN</p>
        <br><br><br>
        <p><strong>Drs. H. ARINARSA JS</strong><br>
        Pembina Utama Madya (IV/d)<br>
        NIP. 197106031991011002</p>
    </div>
</body>
</html>
