@extends('layout.main')

@section('title', 'pemilik')

@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Masukan Data Pemilik</h4>
            <p class="card-description">
                Form Data Pemilik
            </p>
            <form method="POST" action="{{route('pemilik.store')}}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama/Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{old('nama')}}"
                        placeholder="Masukan nama ">
                    @error('nama')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nik">NIK/NPWP PRIBADI/PERUSAHAAN</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{old('nik')}}"
                        placeholder="Masukan NIK/NPWP">
                    @error('nik')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{old('alamat')}}"
                        placeholder="Masukan Alamat ">
                    @error('alamat')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="{{old('telepon')}}"
                        placeholder="Masukan No.Telepon">
                    @error('telepon')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}"
                        placeholder="Masukan email">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{url('pemilik')}}"></a>
            </form>
        </div>
    </div>
</div>
@endsection