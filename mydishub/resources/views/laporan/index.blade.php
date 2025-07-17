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

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Data Surat -->
    <h5 class="fw-bold mb-3">Tabel Data Surat</h5>
    <table class="table table-bordered table-hover" style="font-size: 15px;">
        <thead class="table-dark text-center">
            <tr>
                <th>Nama Pemilik</th>
                <th>Alamat</th>
                <th>Nik/NPWP</th>
                <th>Nama Kapal</th>
                <th>No Plat</th>
                <th>tandaselar</th>
                <th>Jenis Perizinan</th>
                <th>Tujuan</th>
                <th>Dokumen Penting</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($surats as $surat)
                <tr>
                    <td>{{ $surat->pemilik->nama }}</td>
                    <td>{{ $surat->pemilik->alamat }}</td>
                    <td>{{ $surat->pemilik->nik }}</td>
                    <td>{{ $surat->kapal->nama }}</td>
                    <td>{{ $surat->kapal->noplat }}</td>
                    <td>{{ $surat->kapal->tandaselar }}</td>
                    <td>{{ $surat->kapal->jenisperizinan }}</td>
                    <td>{{ $surat->kapal->tujuan ?? '-' }}</td>
                    <td>
                        @if($surat->pemilik->file_ktp)
                            <a href="{{ Storage::url($surat->pemilik->file_ktp) }}" target="_blank" class="btn btn-sm btn-primary mb-1">
                                <i class="mdi mdi-account-card-details"></i> KTP
                            </a><br>
                        @else
                            <span class="text-muted d-block">KTP - Tidak Ada</span>
                        @endif

                        @if($surat->kapal->file_stnk)
                            <a href="{{ Storage::url($surat->kapal->file_stnk) }}" target="_blank" class="btn btn-sm btn-info mt-1">
                                <i class="mdi mdi-file-document"></i> STNK
                            </a>
                        @else
                            <span class="text-muted d-block">Dokumen - Tidak Ada</span>
                        @endif
                    </td>
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
                    <td colspan="10" class="text-center">Tidak ada data surat ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tabel Aksi -->
    <h5 class="fw-bold mt-5 mb-3">Tabel Aksi Pemrosesan</h5>
    <table class="table table-bordered table-striped mb-5" style="font-size: 15px;">
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
                                <button class="btn btn-sm btn-outline-success btn-konfirmasi"
                                        data-url="{{ route('surat.proses', $surat->id) }}"
                                        data-action="proses">Proses</button>
                                <button class="btn btn-sm btn-outline-danger btn-konfirmasi"
                                        data-url="{{ route('surat.tolak', $surat->id) }}"
                                        data-action="tolak">Tolak</button>
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

    <!-- Tabel Data Perpanjang Surat -->
    <h5 class="fw-bold mb-3">Tabel Data Perpanjang Surat</h5>
    <table class="table table-bordered table-striped mb-5" style="font-size: 15px;">
        <thead class="table-dark text-center">
            <tr>
                <th>Nama Pemilik</th>
                <th>Alamat</th>
                <th>Nik</th>
                <th>Nama Kapal</th>
                <th>No Plat</th>
                <th>tandaselar</th>
                <th>Jenis Perizinan</th>
                <th>Tujuan</th>
                <th>Dokumen Penting</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perpanjang as $ps)
                <tr>
                    <td>{{ $ps->surat->pemilik->nama }}</td>
                    <td>{{ $ps->surat->pemilik->alamat }}</td>
                    <td>{{ $ps->surat->pemilik->nik }}</td>
                    <td>{{ $ps->surat->kapal->nama }}</td>
                    <td>{{ $ps->surat->kapal->noplat }}</td>
                    <td>{{ $ps->surat->kapal->tandaselar }}</td>
                    <td>{{ $ps->surat->kapal->jenisperizinan }}</td>
                    <td>{{ $ps->surat->kapal->tujuan ?? '-' }}</td>
                    <td>
                        @if($ps->surat->pemilik->file_ktp)
                            <a href="{{ Storage::url($ps->surat->pemilik->file_ktp) }}" target="_blank" class="btn btn-sm btn-primary mb-1">
                                <i class="mdi mdi-account-card-details"></i> KTP
                            </a><br>
                        @else
                            <span class="text-muted d-block">KTP - Tidak Ada</span>
                        @endif

                        @if($ps->surat->kapal->file_stnk)
                            <a href="{{ Storage::url($ps->surat->kapal->file_stnk) }}" target="_blank" class="btn btn-sm btn-info mt-1">
                                <i class="mdi mdi-file-document"></i> STNK
                            </a>
                        @else
                            <span class="text-muted d-block">Dokumen - Tidak Ada</span>
                        @endif
                    </td>
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
                    <td colspan="10" class="text-center">Tidak ada data surat ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Aksi Pemrosesan Perpanjangan -->
    <h5 class="fw-bold mt-5 mb-3">Tabel Aksi Pemrosesan Perpanjang Surat</h5>
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
                                <button class="btn btn-sm btn-outline-success btn-konfirmasi"
                                        data-url="{{ route('perpanjangsurat.proses2', $ps->id) }}"
                                        data-action="proses">Proses</button>
                                <button class="btn btn-sm btn-outline-danger btn-konfirmasi"
                                        data-url="{{ route('perpanjangsurat.tolak', $ps->id) }}"
                                        data-action="tolak">Tolak</button>
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
