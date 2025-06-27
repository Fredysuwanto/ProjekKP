@extends('layout.main')

@section('content')
<div class="container">
    <h1 class="mb-4">Buat Surat Baru</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('perpanjangsurat.store') }}">
        @csrf

        <div class="mb-3">
            <label for="riwayat_id" class="form-label">Pilih Surat</label>
<select name="surat_id" class="form-control" required>
    <option value="">-- Pilih Riwayat Surat --</option>
    @foreach($surats as $surat)
        <option value="{{ $surat->id }}">
            {{ $surat->pemilik->nama }} - {{ $surat->kapal->noplat }}
        </option>
    @endforeach
</select>
        </div>

        {{-- <div class="mb-3">
            <label for="riwayat_id" class="form-label">Kapal</label>
            <select name="riwayat_id" id="riwayat_id" class="form-control" required>
                <option value="">-- Pilih Kapal --</option>
                @foreach($kapals as $kapal)
                    <option value="{{ $kapal->id }}" {{ old('riwayat_id') == $kapal->id ? 'selected' : '' }}>
                        {{ $kapal->noplat }} - {{ $kapal->nama }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
