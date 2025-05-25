@extends('layout.main')

@section('title', 'Data Kapal')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Data Kapal</h4>
      <p class="card-description">Daftar Kapal</p>
      
      <a href="{{ route('kapal.create') }}" class="btn btn-rounded btn-primary mb-3">Tambah Kapal</a>

      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>Nama Kapal</th>
              <th>No. Plat</th>
              <th>Jenis</th>
              <th>Ukuran</th>
              <th>Daya Mesin</th>
              <th>Muatan</th>
              <th>Jenis Perizinan</th>
              <th>Aksi</th> <!-- Tambahkan kolom aksi -->
            </tr>
          </thead>
          <tbody>
            @foreach ($kapal as $item)
              <tr>
                <td>{{ $item["nama"] }}</td>
                <td>{{ $item["noplat"] }}</td>
                <td>{{ $item["jenis"] }}</td>
                <td>{{ $item["ukuran"] }}</td>
                <td>{{ $item["daya"] }}</td>
                <td>{{ $item["muatan"] }}</td>
                <td>{{ $item["jenisperizinan"] }}</td>
                <td>
                  <a href="{{ route('kapal.edit', $item['id']) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

@if (session('success'))
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    Swal.fire({
      title: "Good job!",
      text: "{{ session('success') }}",
      icon: "success"
    });
  </script>
@endif
@endsection
