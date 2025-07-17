@extends('layout.main')

@section('title', 'Tambah Kapal')

@section('content')
<div class="col-md-8 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title fw-bold"><i class="mdi mdi-ferry me-1 text-primary"></i> Tambah Kapal</h4>
      <p class="card-description mb-4">Silakan isi data lengkap kapal yang akan ditambahkan.</p>

      {{-- Notifikasi Sukses --}}
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="mdi mdi-check-circle-outline me-1"></i> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <form method="POST" action="{{ route('kapal.store') }}" class="forms-sample" enctype="multipart/form-data">
        @csrf

        {{-- Nama Kapal --}}
        <div class="form-group mb-3">
          <label for="nama">Nama Kapal</label>
          <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Kapal">
          @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- No. Plat --}}
        <div class="form-group mb-3">
          <label for="noplat">No. Plat</label>
          <input type="text" class="form-control" id="noplat" name="noplat" value="{{ old('noplat') }}" placeholder="Masukkan No. Plat">
          @error('noplat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Jenis Kapal --}}
        <div class="form-group mb-3">
          <label for="jenis">Jenis Kapal</label>
          <input type="text" class="form-control" id="jenis" name="jenis" value="{{ old('jenis') }}" placeholder="Masukkan Jenis Kapal">
          @error('jenis') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Ukuran --}}
        <div class="form-group mb-3">
          <label for="ukuran">Ukuran Kapal</label>
          <input type="text" class="form-control" id="ukuran" name="ukuran" value="{{ old('ukuran') }}" placeholder="Masukkan Ukuran Kapal">
          @error('ukuran') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Tanda Selar --}}
        <div class="form-group mb-3">
          <label for="tandaselar">Tanda Selar</label>
          <input type="text" class="form-control" id="tandaselar" name="tandaselar" value="{{ old('tandaselar') }}" placeholder="Masukkan Tanda Selar Kapal">
          @error('tandaselar') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Daya Mesin --}}
        <div class="form-group mb-3">
          <label for="daya">Daya Mesin</label>
          <input type="text" class="form-control" id="daya" name="daya" value="{{ old('daya') }}" placeholder="Masukkan Daya Mesin">
          @error('daya') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Muatan --}}
        <div class="form-group mb-3">
          <label for="muatan">Muatan Kapal</label>
          <input type="text" class="form-control" id="muatan" name="muatan" value="{{ old('muatan') }}" placeholder="Masukkan Muatan Kapal">
          @error('muatan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Jenis Perizinan --}}
        <div class="form-group mb-3">
          <label for="jenisperizinan">Jenis Perizinan Kapal</label>
          <select class="form-control" id="jenisperizinan" name="jenisperizinan">
            <option value="" disabled selected>-- Pilih Jenis Perizinan --</option>
            <option value="Izin Operasional" {{ old('jenisperizinan') == 'Izin Operasional' ? 'selected' : '' }}>Izin Operasional</option>
            <option value="Trayek" {{ old('jenisperizinan') == 'Trayek' ? 'selected' : '' }}>Trayek</option>
          </select>
          @error('jenisperizinan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Tujuan Trayek --}}
        <div class="form-group mb-3" id="tujuan-group" style="display: none;">
          <label for="tujuan">Tujuan Trayek</label>
          <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ old('tujuan') }}" placeholder="Contoh: Palembang - Bangka">
          @error('tujuan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
                <div class="form-group">
    <label for="file_stnk">Upload STNK</label>
    <input type="file" class="form-control" id="file_stnk" name="file_stnk" required>
    @error('file_stnk')
        <span class="text-danger">{{$message}}</span>
    @enderror
</div>
        <button type="submit" class="btn btn-primary me-2">
          <i class="mdi mdi-content-save me-1"></i> Submit
        </button>
        <a href="{{ route('kapal.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const izinSelect = document.getElementById('jenisperizinan');
    const tujuanGroup = document.getElementById('tujuan-group');

    function toggleTujuanField() {
      tujuanGroup.style.display = izinSelect.value === 'Trayek' ? 'block' : 'none';
    }

    izinSelect.addEventListener('change', toggleTujuanField);

    // Panggil saat load awal untuk handle old value
    toggleTujuanField();
  });
</script>
@endsection
