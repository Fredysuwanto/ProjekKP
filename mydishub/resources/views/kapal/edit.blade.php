@extends('layout.main')

@section('title', 'Edit Kapal')

@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Kapal</h4>
            <p class="card-description">
                Form untuk mengedit data kapal
            </p>
            <form method="POST" action="{{ route('kapal.update', $kapal->id) }}" class="forms-sample">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama Kapal</label>
                    <input type="text" class="form-control" id="nama" name="nama" 
                        value="{{ old('nama', $kapal->nama) }}" placeholder="Masukan Nama Kapal">
                    @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="noplat">No.Plat</label>
                    <input type="text" class="form-control" id="noplat" name="noplat" 
                        value="{{ old('noplat', $kapal->noplat) }}" placeholder="Masukan No Plat">
                    @error('noplat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis">Jenis Kapal</label>
                    <input type="text" class="form-control" id="jenis" name="jenis" 
                        value="{{ old('jenis', $kapal->jenis) }}" placeholder="Masukan Jenis Kapal">
                    @error('jenis')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ukuran">Ukuran Kapal</label>
                    <input type="text" class="form-control" id="ukuran" name="ukuran" 
                        value="{{ old('ukuran', $kapal->ukuran) }}" placeholder="Masukan Ukuran Kapal">
                    @error('ukuran')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tandaselar">Tanda Selar</label>
                    <input type="text" class="form-control" id="tandaselar" name="tandaselar" 
                        value="{{ old('tandaselar', $kapal->tandaselar) }}" placeholder="Masukan tandaselar Kapal">
                    @error('tandaselar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="daya">Daya Mesin</label>
                    <input type="text" class="form-control" id="daya" name="daya" 
                        value="{{ old('daya', $kapal->daya) }}" placeholder="Masukan Daya Mesin">
                    @error('daya')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="muatan">Muatan Kapal</label>
                    <input type="text" class="form-control" id="muatan" name="muatan" 
                        value="{{ old('muatan', $kapal->muatan) }}" placeholder="Masukan Muatan Kapal">
                    @error('muatan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenisperizinan">Jenis Perizinan Kapal</label>
                    <select class="form-control" id="jenisperizinan" name="jenisperizinan">
                        <option value="" disabled>-- Pilih Jenis Perizinan --</option>
                        <option value="Izin Operasional" {{ old('jenisperizinan', $kapal->jenisperizinan) == 'Izin Operasional' ? 'selected' : '' }}>
                            Izin Operasional
                        </option>
                        <option value="Trayek" {{ old('jenisperizinan', $kapal->jenisperizinan) == 'Trayek' ? 'selected' : '' }}>
                            Trayek
                        </option>
                    </select>
                    @error('jenisperizinan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{ url('kapal') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
