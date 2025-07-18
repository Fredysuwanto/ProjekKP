@extends('layout.main')

@section('title', 'Edit Kapal')

@section('content')
<div class="col-md-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Kapal</h4>
            <p class="card-description">Form untuk mengedit data kapal</p>

            {{-- Alert Flash --}}
            @foreach (['success' => 'check-circle', 'error' => 'alert'] as $type => $icon)
                @if (session($type))
                    <div class="alert alert-{{ $type == 'success' ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-{{ $icon }}-outline me-1"></i> {{ session($type) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach

            <form method="POST" action="{{ route('kapal.update', $kapal->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama Pemilik --}}
                <div class="form-group mb-3">
                    <label for="pemilik">Nama Pemilik</label>
                    <input type="text" class="form-control" id="pemilik" value="{{ $kapal->user->name ?? '-' }}" readonly>
                </div>

                {{-- Nama Kapal --}}
                <div class="form-group mb-3">
                    <label for="nama">Nama Kapal</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="{{ old('nama', $kapal->nama) }}" placeholder="Masukan Nama Kapal">
                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- No Plat --}}
                <div class="form-group mb-3">
                    <label for="noplat">No. Plat</label>
                    <input type="text" class="form-control" id="noplat" name="noplat"
                        value="{{ old('noplat', $kapal->noplat) }}" placeholder="Masukan No. Plat">
                    @error('noplat') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Jenis --}}
                <div class="form-group mb-3">
                    <label for="jenis">Jenis Kapal</label>
                    <input type="text" class="form-control" id="jenis" name="jenis"
                        value="{{ old('jenis', $kapal->jenis) }}" placeholder="Masukan Jenis Kapal">
                    @error('jenis') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Ukuran --}}
                <div class="form-group mb-3">
                    <label for="ukuran">Ukuran Kapal</label>
                    <input type="text" class="form-control" id="ukuran" name="ukuran"
                        value="{{ old('ukuran', $kapal->ukuran) }}" placeholder="Masukan Ukuran Kapal">
                    @error('ukuran') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Tanda Selar --}}
                <div class="form-group mb-3">
                    <label for="tandaselar">Tanda Selar</label>
                    <input type="text" class="form-control" id="tandaselar" name="tandaselar"
                        value="{{ old('tandaselar', $kapal->tandaselar) }}" placeholder="Masukan Tanda Selar">
                    @error('tandaselar') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Daya Mesin --}}
                <div class="form-group mb-3">
                    <label for="daya">Daya Mesin</label>
                    <input type="text" class="form-control" id="daya" name="daya"
                        value="{{ old('daya', $kapal->daya) }}" placeholder="Masukan Daya Mesin">
                    @error('daya') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Muatan --}}
                <div class="form-group mb-3">
                    <label for="muatan">Muatan Kapal</label>
                    <input type="text" class="form-control" id="muatan" name="muatan"
                        value="{{ old('muatan', $kapal->muatan) }}" placeholder="Masukan Muatan Kapal">
                    @error('muatan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Jenis Perizinan --}}
                <div class="form-group mb-3">
                    <label for="jenisperizinan">Jenis Perizinan Kapal</label>
                    <select class="form-select" id="jenisperizinan" name="jenisperizinan">
                        <option value="" disabled {{ old('jenisperizinan', $kapal->jenisperizinan) == '' ? 'selected' : '' }}>
                            -- Pilih Jenis Perizinan --
                        </option>
                        <option value="Izin Operasional" {{ old('jenisperizinan', $kapal->jenisperizinan) == 'Izin Operasional' ? 'selected' : '' }}>
                            Izin Operasional
                        </option>
                        <option value="Trayek" {{ old('jenisperizinan', $kapal->jenisperizinan) == 'Trayek' ? 'selected' : '' }}>
                            Trayek
                        </option>
                    </select>
                    @error('jenisperizinan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- Tujuan (Hanya jika Trayek) --}}
                <div class="form-group mb-3" id="tujuan-group" style="display: none;">
                    <label for="tujuan">Tujuan Trayek</label>
                    <input type="text" class="form-control" id="tujuan" name="tujuan"
                        value="{{ old('tujuan', $kapal->tujuan) }}" placeholder="Contoh: Palembang - Bangka">
                    @error('tujuan') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                {{-- STNK --}}
                <div class="form-group">
                    <label for="file_stnk">Update STNK</label>
                    <input type="file" class="form-control" id="file_stnk" name="file_stnk">
                    @error('file_stnk') <span class="text-danger">{{ $message }}</span> @enderror

                    @if($kapal->file_stnk)
                        <small class="text-muted">File saat ini: 
                            <a href="{{ Storage::url($kapal->file_stnk) }}" target="_blank">Lihat</a>
                        </small>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary me-2">
                    <i class="mdi mdi-content-save-outline me-1"></i> Update
                </button>
                <a href="{{ route('kapal.index') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectIzin = document.getElementById('jenisperizinan');
        const tujuanGroup = document.getElementById('tujuan-group');

        function toggleTujuan() {
            tujuanGroup.style.display = selectIzin.value === 'Trayek' ? 'block' : 'none';
        }

        selectIzin.addEventListener('change', toggleTujuan);
        toggleTujuan();
    });
</script>
@endsection
