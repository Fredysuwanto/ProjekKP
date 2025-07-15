@extends('layout.main') 

@section('content')
<div class="container">
    <h1 class="mb-4">Buat Surat Baru</h1>
        <div class="col-12 mt-2">
        <div class="alert alert-warning shadow-sm">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            <strong>Pilih data pemilik dan kapal yang ingin didaftarkan.</strong>
        </div>
    </div>
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

    <form method="POST" action="{{ route('surat.store') }}">
        @csrf

        <div class="mb-3">
            <label for="pemilik_id" class="form-label">Pemilik</label>
            <select name="pemilik_id" id="pemilik_id" class="form-control" required>
                <option value="">-- Pilih Pemilik --</option>
                @foreach($pemiliks as $pemilik)
                    <option value="{{ $pemilik->id }}" {{ old('pemilik_id') == $pemilik->id ? 'selected' : '' }}>
                        {{ $pemilik->nama }} - {{ $pemilik->alamat }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kapal_id" class="form-label">Kapal</label>
            <select name="kapal_id" id="kapal_id" class="form-control" required>
                <option value="">-- Pilih Kapal --</option>
                @foreach($kapals as $kapal)
                    @php
                        // Kapal dianggap sudah terdaftar surat bila ada surat aktif (null, diproses, disetujui)
                        $sudahAdaSurat = $kapal->surats()
                            ->whereIn('status', [null, 'diproses', 'disetujui'])
                            ->exists();
                    @endphp

                    @unless($sudahAdaSurat)
                        <option value="{{ $kapal->id }}" {{ old('kapal_id') == $kapal->id ? 'selected' : '' }}>
                            {{ $kapal->noplat }} - {{ $kapal->nama }}
                        </option>
                    @endunless
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
