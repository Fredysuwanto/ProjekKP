@extends('layout.main')

@section('title','tambah menu')

@section('content')

<style>
    .tabel-kita{
      padding-left: 400px;
      padding-right: 200px;
    }
  </style>
<div class="tabel-kita">
<h2 class="my-6 text-2xl font-semibold text-gray-700">Tambah Menu</h2>
<div class ="row">
    {{-- formulir tambah fakultas --}}
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body"> 
        <form method="POST" action="{{route('menu.store') }}" class="forms-sample" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label class="block text-sm" for="kategori_id">Kategori</label>
          <select class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"  id="kategori_id" name="kategori_id" >
              @foreach ($kategori as $items)
              <option value="{{$items['id']}}">
                  {{$items['nama_kategori']}}
              </option>
              @endforeach
          </select>
      </div>
          <div class="form-group">
            <label for="nomor_menu">Nomor Menu</label>
              <input type="text" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" id= "nomor_menu" name="nomor_menu" placeholder="Nomor Menu" value="{{old('nomor_menu')}}">
                @error('nomor_menu')
                  <span class = "text-danger">{{$message }}</span>
                @enderror
          </div>
          <div class="form-group">
            <label for="url_menu">Url Foto</label>
            <input type="url" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" name="url_menu" placeholder="url"  value="{{old('url_menu')}}">
            @error('url_menu')
              <span class = "text-danger">{{$message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="nama_menu">Nama Menu</label>
              <input type="text" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" id= "nama_menu" name="nama_menu" placeholder="Nama Menu" value="{{old('nama_menu')}}">
                @error('nama_menu')
                  <span class = "text-danger">{{$message }}</span>
                @enderror
          </div>
          <div class="form-group">
            <label for="harga_menu">Harga Menu</label>
              <input type="text" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" id= "harga_menu" name="harga_menu" placeholder="Harga Menu" value="{{old('harga_menu')}}">
                @error('harga_menu')
                  <span class = "text-danger">{{$message }}</span>
                @enderror
            </div>
            <br>
            <button type="submit" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Submit</button>
            <a href="{{url('menu')}}" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Batal</a>
      </form>
    </div>
  </div>
</div>
</div>
@endsection
    