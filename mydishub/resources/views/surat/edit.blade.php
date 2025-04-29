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
        Reservasi
      </h2>
<br>
            <form method="POST" action="{{route('reservasi.update',$reservasi['id'])}}" class="forms-sample" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="block text-sm" for="meja_id">Nomor Meja</label>
                    <select class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"  id="meja_id" name="meja_id" >
                        @foreach ($meja as $items)
                        <option value="{{$items['id']}}">
                            {{$items['nomor_meja']}}
                        </option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                    <label for="no_reservasi">Nomor Reservasi </label>
                        <input type="text" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" id="no_reservasi" name="no_reservasi" value="{{old('no_reservasi') ? old('no_reservasi') : $reservasi['no_reservasi'] }}"
                            placeholder="Masukan Nama">
                        @error('no_reservasi')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                    <label class="block text-sm" for="menu_id">Pesanan</label>
                    <select class="block w-full mt-1 text-sm dark:text-gray-300 dborder-gray-600 bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"  id="menu_id" name="menu_id" >
                        @foreach ($menu as $items)
                        <option value="{{$items['id']}}">
                            {{$items['nama_menu']}}
                        </option>
                    @endforeach
                </select>

                <div class="form-group">
                    <label for="nama">Nama </label>
                        <input type="text" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" id="nama" name="nama" value="{{old('nama') ? old('nama') : $reservasi['nama'] }}"
                            placeholder="Masukan Nama">
                        @error('nama')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="no_telpon">Nomor Telepon</label>
                    <input type="text" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" id="no_telpon" name="no_telpon" value="{{old('no_telpon') ? old('no_telpon'): $reservasi['no_telpon'] }}"
                        placeholder="Masukan No Telepon">
                    @error('no_telpon')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal_reservasi">Tanggal Reservasi</label>
                    <input type="datetime-local" class="block w-full mt-1 text-sm border-gray-600 bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple text-gray-300 focus:shadow-outline-gray form-input" id="tanggal_reservasi" name="tanggal_reservasi" value="{{old('tanggal_reservasi') ? old('tanggal_reservasi'): $reservasi['tanggal_reservasi'] }}"
                        placeholder="Pilih Tanggal Reservasi">
                    @error('tanggal_reservasi')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div><br>
                
                
                <button type="submit" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Submit</button>
                <a href="{{url('reservasi')}}"class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection