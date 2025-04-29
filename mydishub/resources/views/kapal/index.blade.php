@extends('layout.main')

@section('title','menu')

@section('content')

<style>
  .tabel-kita{
    padding-left: 300px;
    padding-right: 300px;
  }
  .card-img-top{
    width: 100%;
    height: 250px; 
    object-fit: cover; 
  }
  .menu-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  .menu-item {
    width: 48%;
    margin-bottom: 20px;
    box-sizing: border-box;
  }
  .button-container {
    display: flex;
    justify-content: space-between;
  }
</style>
<div class="tabel-kita">
<div class="container">
<h2 class="text-2xl font-semibold text-gray-700">Menu Makanan Volta Restaurant</h2>
<br>
<div>
   @can('create', App\Menu::class)
    <a href="{{route('menu.create')}}" class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Tambah Menu</a>
    @endcan
  <div>
    <br>
    <div class="menu-container">
      @foreach ($menu as $item)
      <div class="menu-item">
        <div class="card">
          <div class="card-body">
            <br>
            <img src={{ $item['url_menu'] }} class="card-img-top">
            <p class="card-title">Kategori : {{ $item["kategori"]["nama_kategori"]}}</p>
            <p class="card-text">Nomor Menu : {{ $item["nomor_menu"]}} </p>
            <p class="card-text">{{ $item["nama_menu"]}} : Rp{{ $item["harga_menu"]}}</p>
            <br>
            <div class="button-container">
              @can('delete', $item)
                <form action="{{route('menu.destroy', $item["id"])}}" method="post">
                @method('DELETE')
                  @csrf
                  <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-red show_confirm" data-name="{{ $item["nama_menu"] }}">Hapus</button>
                </form>
                <a href="{{route('menu.edit', $item["id"])}}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-red">Edit</a>
              @endcan
            </div>
          </div>  
        </div> 
      </div>
      @endforeach
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if (session('success'))
    <script>
      Swal.fire({
        title: "Good job!",
        text: "{{session('success')}}",
        icon: "success"
      });
    </script>
  @endif
  
  <script type="text/javascript">
    $('.show_confirm').click(function(event) {
      let form = $(this).closest("form");
      let name = $(this).data("name");
      event.preventDefault();
      Swal.fire({
        title: "Apakah Kamu Yakin " + name + " Data ini di hapus?",
        text: "Data yang sudah di hapus tidak akan bisa kembali!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Iya saya yakin!"
      })
      .then((willDelete) => {
        if (willDelete.isConfirmed) {
          form.submit();
        }
      });
    });
  </script>
  
  @endsection
  