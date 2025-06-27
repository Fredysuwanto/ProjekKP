{{-- @extends('layout.main')

@section('content')
<div class="container">
    <h1>Edit Surat</h1>
    <form method="POST" action="{{ route('surat.update', $surat->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Pemilik</label>
            <select name="pemilik_id" class="form-control" required>
                @foreach($pemiliks as $pemilik)
                <option value="{{ $pemilik->id }}" {{ $surat->pemilik_id == $pemilik->id ? 'selected' : '' }}>
                    {{ $pemilik->nama }} - {{ $pemilik->alamat }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Kapal</label>
            <select name="kapal_id" class="form-control" required>
                @foreach($kapals as $kapal)
                <option value="{{ $kapal->id }}" {{ $surat->kapal_id == $kapal->id ? 'selected' : '' }}>
                    {{ $kapal->nama_kapal }} - {{ $kapal->tanda_selar }}
                </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection --}}
