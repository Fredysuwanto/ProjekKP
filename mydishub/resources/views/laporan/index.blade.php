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
                <th>Dokumen Penting</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kapals as $kapal)
                <tr>
                    <td>{{ $kapal->user->name ?? '-' }}</td>
                    <td>{{ $kapal->nama }}</td>
                    <td>{{ $kapal->noplat }}</td>
                    <td>{{ $kapal->jenis }}</td>
                    <td>{{ $kapal->jenisperizinan }}</td>
                    <td>{{ $kapal->tujuan ?? '-' }}</td>
                    <td class="text-center">
                        <!-- STNK -->
                        @if($kapal->file_stnk)
                            <a href="{{ Storage::url($kapal->file_stnk) }}" target="_blank" class="btn btn-sm btn-info mb-1">
                                <i class="mdi mdi-file-document"></i> STNK
                            </a>
                        @else
                            <span class="text-muted d-block">STNK: Tidak Ada</span>
                        @endif

                        <!-- KTP -->
                        @if($kapal->user && $kapal->user->pemilik && $kapal->user->pemilik->file_ktp)
                            <a href="{{ Storage::url($kapal->user->pemilik->file_ktp) }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="mdi mdi-card-account-details"></i> KTP
                            </a>
                        @else
                            <span class="text-muted d-block">KTP: Tidak Ada</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @php $status = $kapal->status ?? 'menunggu'; @endphp
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
            @forelse ($kapals->where('status', null) as $kapal)
                <tr>
                    <td>{{ $kapal->user->name ?? '-' }}</td>
                    <td>{{ $kapal->nama }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-sm btn-outline-success btn-konfirmasi"
                                    data-url="{{ route('kapal.proses', $kapal->id) }}"
                                    data-action="proses">Proses</button>
                            <button class="btn btn-sm btn-outline-danger btn-konfirmasi"
                                    data-url="{{ route('kapal.tolak', $kapal->id) }}"
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
                    judul = 'Proses Kapal?';
                    pesan = 'Apakah data kapal sudah valid dan ingin diproses sekarang?';
                    icon = 'info';
                } else if (action === 'tolak') {
                    judul = 'Tolak Kapal?';
                    pesan = 'Apakah Anda yakin ingin menolak kapal ini? Tindakan ini tidak bisa dibatalkan.';
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
