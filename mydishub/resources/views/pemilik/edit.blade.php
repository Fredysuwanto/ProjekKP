@extends('layout.main')

@section('title', 'pemilik')

@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Pemilik</h4>    
            <p class="card-description">
                Form Edit Pemilik
            </p>
            <form method="POST" action="{{route('pemilik.update', $pemilik['id']) }}" class="forms-sample" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="nama">Nama/Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{old('nama') ? old('nama'): $pemilik['nama'] }}"
                        placeholder="Masukan nama atau Nama Perusahaan ">
                    @error('nama')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nik">NIK/NPWP/Data Perusahaan</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{old('nik') ? old('nik'): $pemilik['nik'] }}"
                        placeholder="Masukan nik">
                    @error('nik')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{old('alamat') ? old('alamat'): $pemilik['alamat'] }}"
                        placeholder="Masukan Tempat Lahir">
                    @error('alamat')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="{{old('telepon') ? old('telepon'): $pemilik['telepon'] }}"
                        placeholder="Masukan Nomor Telepon Anda">
                    @error('telepon')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{old('email') ? old('email'): $pemilik['email']}}"
                        placeholder="Masukan email">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{url('pemilik')}}"></a>
            </form>
        </div>
    </div>
</div>
@endsection