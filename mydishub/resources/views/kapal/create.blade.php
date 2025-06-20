@extends('layout.main')

@section('title', 'kapal')

@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Kapal</h4>
            <p class="card-description">
                Masukan Kapal Dan Jenis Izin
            </p>
            <form method="POST" action="{{ route('kapal.store') }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Kapal</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}"
                        placeholder="Masukan Nama Kapal">
                    @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="noplat">No.Plat</label>
                    <input type="text" class="form-control" id="noplat" name="noplat" value="{{ old('noplat') }}"
                        placeholder="Masukan noplat">
                    @error('noplat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis">Jenis Kapal</label>
                    <input type="text" class="form-control" id="jenis" name="jenis" value="{{ old('jenis') }}"
                        placeholder="Masukan jenis Kapal">
                    @error('jenis')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ukuran">Ukuran Kapal</label>
                    <input type="text" class="form-control" id="ukuran" name="ukuran" value="{{ old('ukuran') }}"
                        placeholder="Masukan ukuran Kapal">
                    @error('ukuran')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="daya">Daya Mesin</label>
                    <input type="text" class="form-control" id="daya" name="daya" value="{{ old('daya') }}"
                        placeholder="Masukan daya mesin kapal">
                    @error('daya')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="muatan">Muatan Kapal</label>
                    <input type="text" class="form-control" id="muatan" name="muatan" value="{{ old('muatan') }}"
                        placeholder="Masukan muatan Kapal">
                    @error('muatan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Dropdown pilihan jenis perizinan --}}
                <div class="form-group">
                    <label for="jenisperizinan">Jenis Perizinan Kapal</label>
                    <select class="form-control" id="jenisperizinan" name="jenisperizinan">
                        <option value="" disabled selected>-- Pilih Jenis Perizinan --</option>
                        <option value="Izin Operasional" {{ old('jenisperizinan') == 'Izin Operasional' ? 'selected' : '' }}>
                            Izin Operasional
                        </option>
                        <option value="Trayek" {{ old('jenisperizinan') == 'Trayek' ? 'selected' : '' }}>
                            Trayek
                        </option>
                    </select>
                    @error('jenisperizinan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ url('kapal') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
