@extends('layout.main')

@section('content')
<div class="container">
    <h1>Edit Riwayat</h1>
    <form method="POST" action="{{ route('riwayat.update', $riwayat->id) }}"enctype="multipart/form-data"onsubmit="this.querySelector('button[type=submit]').disabled = true;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nosurat">Nomor Surat</label>
            <input type="text" class="form-control" id="nosurat" name="nosurat" value="{{old('nosurat') ? old('nosurat'): $riwayat['nosurat'] }}"
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

        <div class="mb-3">
            <label for="file_surat">File Surat (PDF)</label>
            <input type="file" name="file_surat" class="form-control" accept="application/pdf">

            @if ($riwayat->file_surat)
                <p class="mt-2">
                    File lama: <a href="{{ asset('storage/' . $riwayat->file_surat) }}" target="_blank">Lihat PDF</a>
                </p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
