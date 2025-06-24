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
        .text-center {
            text-align: center;
        }
        .mt-4 {
            margin-top: 1.5rem;
        }
        .mt-2 {
            margin-top: 0.75rem;
        }
        .mb-2 {
            margin-bottom: 0.75rem;
        }
        .signature {
            margin-top: 60px;
            text-align: right;
        }
        table td {
            vertical-align: top;
            padding: 4px 0;
        }
    </style>
</head>
<body>

    <h2 class="text-center">SURAT PERSETUJUAN PENGOPERASIAN</h2>
    <h3 class="text-center">KAPAL SUNGAI DAN DANAU</h3>

    <p class="text-center mt-2">Nomor : 551.31 / 0001 / 4 /DISHUB-25</p>

    <p>
        Berdasarkan Surat Permohonan Penerbitan Persetujuan Pengoperasian Kapal Sungai dan Danau Perorangan : 
        <u>{{ $surat->pemilik->nama ?? '................' }}</u> 
        Nomor : <u>-</u>, diberikan Persetujuan Pengoperasian Kapal Sungai dan Danau kepada:
    </p>

    <table style="margin-top: 10px;">
        <tr>
            <td style="width: 250px;">NAMA KAPAL</td>
           <td>: {{ strtoupper($surat->kapal->jenis ?? '') }} “{{ $surat->kapal->nama ?? '...................' }}”</td>

        </tr>
        <tr>
            <td>UKURAN</td>
            <td>: {{ $surat->kapal->ukuran ?? '..,.. X ..,.. X ..,.. M' }}</td>
        </tr>
        <tr>
            <td>TANDA SELAR / NO. PLAT</td>
            <td>: {{ $surat->kapal->tandaselar ?? 'GT. .... NO. ......' }}</td>
        </tr>
        <tr>
            <td>DI PERAIRAN SUNGAI DAN DANAU</td>
            <td>: SUMATERA SELATAN</td>
        </tr>
        <tr>
            <td>ALAMAT PEMILIK / PENANGGUNG JAWAB</td>
            <td>: {{ $surat->pemilik->alamat ?? '.......................................................' }}</td>
        </tr>
        <tr>
            <td>NPWP / KTP</td>
            <td>: {{ $surat->pemilik->nik ?? '.......................................................' }}</td>
        </tr>
    </table>

    <p class="mt-4"><strong>KEWAJIBAN PEMEGANG (SPPKSD):</strong></p>
    <ol>
        <li>Memiliki izin yang sah.</li>
        <li>Mengoperasikan kapal yang memenuhi persyaratan keselamatan (laik laut), sesuai dengan peraturan yang berlaku.</li>
        <li>Selambat-lambatnya dalam waktu 1 (satu) bulan setelah memperoleh Persetujuan Pengoperasian Kapal Sungai dan Danau perusahaan harus melakukan kegiatan yang nyata.</li>
        <li>Mematuhi penggunaan dermaga ataupun tempat tambatan lain yang ditetapkan oleh pihak-pihak lain yang berwenang.</li>
        <li>Menghindari segala sesuatu yang dapat menimbulkan pencemaran lingkungan.</li>
        <li>Melaporkan kegiatan operasional kepada Dirjen Perhubungan Darat / Gubernur Sumsel melalui Dinas Perhubungan Provinsi Sumatera Selatan secara periodik sesuai ketentuan yang berlaku.</li>
    </ol>

    <p>
        Surat Persetujuan ini dapat ditinjau kembali atau dicabut apabila pemegang tidak mematuhi ketentuan atau melakukan tindak pidana terkait usaha ini.
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
