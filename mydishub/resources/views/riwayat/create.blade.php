@extends('layout.main')

@section('content')
<div class="container">
    <h1>Buat Riwayat Baru</h1>
    <form method="POST" action="{{ route('riwayat.store') }}"enctype="multipart/form-data"onsubmit="this.querySelector('button[type=submit]').disabled = true;">
        @csrf
        <div class="mb-3">
            <label for="nosurat">Nomor Surat</label>
            <input type="text" class="form-control" id="nosurat" name="nosurat" value="{{old('nosurat')}}"
                placeholder="Masukan Nomor Surat">
            @error('nosurat')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </select>
        </div>
        <div class="mb-3">
            <label>Kapal</label>
            <select name="kapal_id" class="form-control" required>
                <option value="">-- Pilih Kapal --</option>
                    @foreach($kapals as $kapal)
                        <option value="{{ $kapal->id }}">
                            {{ $kapal->noplat }} - {{ $kapal->jenisperizinan }}
                        </option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="file_surat">Upload File Surat (PDF)</label>
            <input type="file" name="file_surat" class="form-control" accept="application/pdf">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
