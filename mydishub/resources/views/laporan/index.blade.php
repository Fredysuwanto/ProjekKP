@extends('layout.main')

@section('title', 'Laporan Kapal')
@section('content')
<div class="container p-5 shadow bg-white rounded" style="font-family: 'Times New Roman', Times, serif;">

    <!-- Header -->
    <div class="text-center mb-4">
        <h2 class="fw-bold">LAPORAN KAPAL TERDAFTAR</h2>
        <p><em>Daftar kapal yang telah diajukan oleh pengguna</em></p>
        <hr style="border: 1px solid black; width: 60%;">
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Data Kapal -->
    <h5 class="fw-bold mb-3">Tabel Data Kapal</h5>
    <table class="table table-bordered table-hover" style="font-size: 15px;">
        <thead class="table-dark text-center">
            <tr>
                <th>Nama Pemilik</th>
                <th>Nama Kapal</th>
                <th>No Plat</th>
                <th>Jenis</th>
                <th>Perizinan</th>
                <th>Tujuan</th>
                <th>Dokumen</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($surats as $surat)
                <tr>
                    <td>{{ $surat->user->name ?? '-' }}</td>
                    <td>{{ $surat->nama }}</td>
                    <td>{{ $surat->noplat }}</td>
                    <td>{{ $surat->jenis }}</td>
                    <td>{{ $surat->jenisperizinan }}</td>
                    <td>{{ $surat->tujuan ?? '-' }}</td>
                    <td class="text-center">
                        <!-- STNK -->
                        @if($surat->file_stnk)
                            <a href="{{ Storage::url($surat->file_stnk) }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                <i class="mdi mdi-file-document"></i> STNK
                            </a>
                        @else
                            <span class="text-muted d-block">STNK: Tidak Ada</span>
                        @endif

                        <!-- KTP -->
                        @if($surat->user && $surat->user->pemilik && $surat->user->pemilik->file_ktp)
                            <a href="{{ Storage::url($surat->user->pemilik->file_ktp) }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="mdi mdi-card-account-details"></i> KTP
                            </a>
                        @else
                            <span class="text-muted d-block">KTP: Tidak Ada</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @php $status = $surat->status ?? 'menunggu'; @endphp
                        @if ($status === 'diproses')
                            <span class="badge bg-success">Diproses</span>
                        @elseif ($status === 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-secondary">Belum Diproses</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data kapal ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tabel Aksi Pemrosesan Kapal -->
    <h5 class="fw-bold mt-5 mb-3">Tabel Aksi Pemrosesan Kapal</h5>
    <table class="table table-bordered table-striped" style="font-size: 15px;">
        <thead class="table-light text-center">
            <tr>
                <th>Nama Pemilik</th>
                <th>Nama Kapal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($surats->where('status', null) as $surat)
                <tr>
                    <td>{{ $surat->user->name ?? '-' }}</td>
                    <td>{{ $surat->nama }}</td>
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
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada kapal untuk diproses.</td>
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
                <th>Nama Kapal</th>
                <th>No Plat</th>
                <th>Jenis Perizinan</th>
                <th>Tujuan</th>
                <th>Dokumen</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perpanjang as $ps)
                <tr>
                    <td>{{ $ps->surat->user->name }}</td>
                    <td>{{ $ps->surat->nama }}</td>
                    <td>{{ $ps->surat->noplat }}</td>
                    <td>{{ $ps->surat->jenisperizinan }}</td>
                    <td>{{ $ps->surat->tujuan ?? '-' }}</td>
                    <td class= text-center>
                        @if($ps->surat->user->pemilik->file_ktp)
                            <a href="{{ Storage::url($ps->surat->user->pemilik->file_ktp) }}" target="_blank" class="btn btn-sm btn-primary mb-1">
                                <i class="mdi mdi-account-card-details"></i> KTP
                            </a><br>
                        @else
                            <span class="text-muted d-block">KTP - Tidak Ada</span>
                        @endif

                        @if($ps->surat->file_stnk)
                            <a href="{{ Storage::url($ps->surat->file_stnk) }}" target="_blank" class="btn btn-sm btn-info mt-1">
                                <i class="mdi mdi-file-document"></i> STNK
                            </a>
                        @else
                            <span class="text-muted d-block">Dokumen - Tidak Ada</span>
                        @endif
                    </td>
                                        <td class="text-center">
                        @php $status = $surat->status ?? 'menunggu'; @endphp
                        @if ($status === 'diproses')
                            <span class="badge bg-success">Diproses</span>
                        @elseif ($status === 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-secondary">Belum Diproses</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data kapal ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Tabel Aksi Pemrosesan Surat Perpanjangan -->
    <h5 class="fw-bold mt-5 mb-3">Tabel Aksi Pemrosesan Surat perpanjangan</h5>
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
                        <td>{{ $ps->surat->user->name }}</td>
                        <td>{{ $ps->surat->nama }}</td>
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
                    pesan = 'Apakah data surat sudah valid dan ingin diproses sekarang?';
                    icon = 'info';
                } else if (action === 'tolak') {
                    judul = 'Tolak Surat?';
                    pesan = 'Apakah Anda yakin ingin menolak Surat ini? Tindakan ini tidak bisa dibatalkan.';
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
