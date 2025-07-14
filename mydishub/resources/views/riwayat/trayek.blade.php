<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Persetujuan Trayek</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            margin: 30px;
        }

        h3 {
            text-align: center;
            margin: 0;
            font-weight: bold;
        }

        p {
            margin: 5px 0;
        }

        ol {
            margin: 0;
            padding-left: 20px;
        }

        table {
            width: 100%;
            margin-top: 10px;
        }

        td {
            vertical-align: top;
            padding: 2px;
        }

        .section {
            margin-top: 15px;
        }

        .signature {
            margin-top: 60px;
            text-align: right;
        }
    </style>
</head>
<body>

    <h3>SURAT PERSETUJUAN TRAYEK</h3>
    <h3>ANGKUTAN SUNGAI DAN DANAU ANTAR KABUPATEN / KOTA DALAM PROVINSI</h3>

    <p><strong>Nomor:</strong> 551.31 / 0001 / 4 /DISHUB-25</p>

    <div class="section">
        <strong>DASAR HUKUM</strong>
        <ol>
            <li>Undang-Undang RI Nomor 17 Tahun 2008 tentang Pelayaran;</li>
            <li>Undang-Undang RI Nomor 28 Tahun 2009 tentang Pajak Daerah dan Retribusi Daerah;</li>
            <li>Undang-Undang RI Nomor 23 Tahun 2014 tentang Pemerintahan Daerah;</li>
            <li>Undang-Undang RI Nomor 11 Tahun 2020 tentang Cipta Kerja;</li>
            <li>Peraturan Pemerintah RI Nomor 20 Tahun 2010 tentang Angkutan di Perairan;</li>
            <li>Peraturan Pemerintah RI Nomor 31 Tahun 2021 tentang Penyelenggaraan Bidang Pelayaran;</li>
            <li>Peraturan Daerah Provinsi Sumatera Selatan Nomor 5 Tahun 2012 tentang Retribusi Perizinan Tertentu.</li>
        </ol>
    </div>

    <div class="section">
        <strong>Surat Permohonan dari:</strong>
        <table>
            <tr>
                <td style="width: 30%;">Nama Pemohon</td>
            <td>: {{ $surat->pemilik->nama ?? '.......................................................' }}</td>
            </tr>
            <tr>
                <td>Alamat Pemilik</td>
            <td>: {{ $surat->pemilik->alamat ?? '.......................................................' }}</td>
            </tr>
            <tr>
                <td>Nama Kapal</td>
            <td>: {{ $surat->kapal->nama ?? '.......................................................' }}</td>
            </tr>
            <tr>
                <td>Tanda Selar</td>
                <td>: {{ $surat->kapal->tandaselar  ?? '................' }}</td>
            </tr>
            <tr>
                <td>Ukuran</td>
            <td>: {{ $surat->kapal->ukuran ?? '.......................................................' }}</td>
            </tr>
            <tr>
                <td>Jenis Kapal</td>
            <td>: {{ $surat->kapal->jenis ?? '.......................................................' }}</td>
            </tr>
            <tr>
                <td>Daya Mesin</td>
            <td>: {{ $surat->kapal->daya ?? '.......................................................' }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ $tanggal ?? '................' }}</td>
            </tr>
            <tr>
                <td>Trayek</td>
                <td>: {{ $kapal->tujuan ?? '................' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <strong>KETENTUAN:</strong>
        <ol>
            <li>Mengoperasikan kapal yang memenuhi persyaratan keselamatan (laik layar), sesuai dengan trayek yang ditetapkan;</li>
            <li>Melaksanakan ketentuan tarif angkutan sungai dan danau;</li>
            <li>Mematuhi penggunaan dermaga ataupun tempat sandar lain yang ditetapkan oleh pihak-pihak yang berwenang;</li>
            <li>Menjamin keselamatan dan kelancaran naik turunnya penumpang, barang, hewan, kendaraan dan muatan lainnya.</li>
        </ol>

        <p>Surat ini berlaku selama 5 (lima) tahun sejak ditandatangani sampai dengan tanggal 
            <strong>{{ $berlaku_sampai ?? '................' }}</strong>
        </p>
    </div>

    <div class="signature">
        <p>Dikeluarkan di: Palembang</p>
        <p>Pada Tanggal: {{ $tanggal ?? '................' }}</p>
        <br><br>
        <p><strong>KEPALA DINAS PERHUBUNGAN</strong><br>PROVINSI SUMATERA SELATAN</p>
        <br><br><br>
        <p><strong>Drs. H. ARINARSA JS</strong><br>Pembina Utama Madya (IV/d)<br>NIP. 19710603 199101 1002</p>
    </div>

</body>
</html>
