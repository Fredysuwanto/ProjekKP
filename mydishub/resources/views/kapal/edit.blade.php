@extends('layout.main')

@section('title', 'menu')

@section('content')
<style>
    .tabel-kita{
      padding-left: 400px;
      padding-right: 200px;
    }
  </style>

<div class="tabel-kita">
    <h2 class="my-6 text-2xl font-semibold text-gray-700">
        Menu
    </h2>
<br>
    <form method="POST" action="{{route('menu.update', $menu['id'])}}" class="forms-sample" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label class="block text-sm" for="kategori_id">Kategori</label>
            <select class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"  id="kategori_id" name="kategori_id"  value="{{old('kategori_id') ? old('kategori_id'): $menu['kategori_id'] }}" >
                @foreach ($kategori as $items)
                <option value="{{$items['id']}}">
                    {{$items['nama_kategori']}}
                </option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label for="nomor_menu">Nama Makanan</label>
                    <input type="text" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" id="nomor_menu" name="nomor_menu" value="{{old('nomor_menu') ? old('nomor_menu'): $menu['nomor_menu'] }}"
                        placeholder="Masukan Nomor Menu">
                    @error('nomor_menu')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
            </div>
        <div class="form-group">
                <label for="url_menu">Url Foto</label>
                <input type="url" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" name="url_menu" value="{{old('url_menu') ? old('url_menu'): $menu['url_menu'] }}">
                @Error('url_menu')
                    <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
            <div class="form-group">
                <label for="nama_menu">Nama Makanan</label>
                    <input type="text" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" id="nama_menu" name="nama_menu" value="{{old('nama_menu') ? old('nama_menu'): $menu['nama_menu'] }}"
                        placeholder="Masukan Nama">
                    @error('nama_menu')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
            </div>
            <div class="form-group">
                <label for="harga_menu">Harga Makanan</label>
                    <input type="text" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" id="harga_menu" name="harga_menu" value="{{old('harga_menu') ? old('harga_menu'): $menu['harga_menu'] }}"
                        placeholder="Masukan Harga">
                    @error('harga_menu')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
            </div>
                <button type="submit" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Submit</button>
                <a href="{{url('menu')}}"class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Batal</a>
    </form>
    </div>
    </div>
</div>
@endsection