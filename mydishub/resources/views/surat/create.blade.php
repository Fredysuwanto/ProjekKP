@extends('layout.main')

@section('content')
<div class="container">
    <h1>Buat Surat Baru</h1>
    <form method="POST" action="{{ route('surat.store') }}">
        @csrf

        <div class="mb-3">
            <label>Pemilik</label>
            <select name="pemilik_id" class="form-control" required>
                <option value="">-- Pilih Pemilik --</option>
                @foreach($pemiliks as $pemilik)
                <option value="{{ $pemilik->id }}">{{ $pemilik->nama }} - {{ $pemilik->alamat }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Kapal</label>
            <select name="kapal_id" class="form-control" required>
                <option value="">-- Pilih Kapal --</option>
                    @foreach($kapals as $kapal)
                        <option value="{{ $kapal->id }}">
                            {{ $kapal->noplat }} - {{ $kapal->nama }}
                        </option>
                    @endforeach

            </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
