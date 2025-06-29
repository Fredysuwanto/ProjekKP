@extends('layout.main')

@section('title', 'Laporan Surat')
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
                <th>tandaselar</th>
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
                    <td>{{ $surat->kapal->tandaselar }}</td>
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
                <th>tandaselar</th>
                <th>Daya Mesin</th>
                <th>Jenis Perizinan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perpanjang as $ps)
                <tr>
                    <td>{{ $ps->surat->pemilik->nama }}</td>
                    <td>{{ $ps->surat->pemilik->alamat }}</td>
                    <td>{{ $ps->surat->kapal->nama }}</td>
                    <td>{{ $ps->surat->kapal->noplat }}</td>
                    <td>{{ $ps->surat->kapal->jenis }}</td>
                    <td>{{ $ps->surat->kapal->ukuran }}</td>
                    <td>{{ $ps->surat->kapal->tandaselar }}</td>
                    <td>{{ $ps->surat->kapal->daya }}</td>
                    <td>{{ $ps->surat->kapal->jenisperizinan }}</td>
                    <td class="text-center">
                        @if ($ps->status === 'Menunggu')
                            <span class="badge bg-secondary">Belum Diproses</span>
                        @elseif ($ps->status === 'diproses')
                            <span class="badge bg-success">Diproses</span>
                        @elseif ($ps->status === 'ditolak')
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
                                <button
                                    class="btn btn-sm btn-outline-success btn-konfirmasi"
                                    data-url="{{ route('surat.proses', $surat->id) }}"
                                    data-action="proses"
                                >
                                    Proses
                                </button>
                                <button
                                    class="btn btn-sm btn-outline-danger btn-konfirmasi"
                                    data-url="{{ route('surat.tolak', $surat->id) }}"
                                    data-action="tolak"
                                >
                                    Tolak
                                </button>
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
            @forelse ($perpanjang as $ps)
                @if ($ps->status === 'Menunggu')
                    <tr>
                        <td>{{ $ps->surat->pemilik->nama }}</td>
                        <td>{{ $ps->surat->kapal->nama }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button
                                    class="btn btn-sm btn-outline-success btn-konfirmasi"
                                    data-url="{{ route('perpanjangsurat.proses2', $ps->id) }}"
                                    data-action="proses"
                                >
                                    Proses
                                </button>
                                <button
                                    class="btn btn-sm btn-outline-danger btn-konfirmasi"
                                    data-url="{{ route('perpanjangsurat.tolak', $ps->id) }}"
                                    data-action="tolak"
                                >
                                    Tolak
                                </button>
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

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.btn-konfirmasi');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                const action = this.getAttribute('data-action');
                let pesan = '';
                let judul = '';
                let icon = 'question';

                if (action === 'proses') {
                    judul = 'Proses Surat?';
                    pesan = 'Apakah data sudah lengkap dan ingin diproses sekarang?';
                    icon = 'info';
                } else if (action === 'tolak') {
                    judul = 'Tolak Surat?';
                    pesan = 'Apakah Anda yakin ingin menolak surat ini? Tindakan ini tidak bisa dibatalkan.';
                    icon = 'warning';
                }

                Swal.fire({
                    title: judul,
                    text: pesan,
                    icon: icon,
                    showCancelButton: true,
                    confirmButtonColor: action === 'proses' ? '#28a745' : '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: action === 'proses' ? 'Ya, Proses!' : 'Ya, Tolak!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>
@endpush
