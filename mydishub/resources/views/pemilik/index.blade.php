@extends('layout.main')

@section('title', 'Data Pemilik')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Data Pemilik Kapal</h4>
      <p class="card-description">Perhatian</p>

      {{-- FLASH MESSAGE --}}
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
        </div>
      @endif

      @if ($pemilik->count() == 0)
        <a href="{{ route('pemilik.create') }}" class="btn btn-rounded btn-primary mb-4">Input</a>
      @endif

      <div class="table-responsive">
        @foreach ($pemilik as $item)
        <table class="table table-bordered mb-4">
          <tr>
            <th style="width: 30%">Data diri/Perusahaan</th>
            <td>{{ $item["nama"] }}</td>
          </tr>
          <tr>
            <th>NIK/NPWP</th>
            <td>{{ $item["nik"] }}</td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td>{{ $item["alamat"] }}</td>
          </tr>
          <tr>
            <th>Telepon</th>
            <td>{{ $item["telepon"] }}</td>
          </tr>
          <tr>
            <th>Email</th>
            <td>{{ $item["email"] }}</td>
          </tr>
          <tr>
            <td colspan="2" class="text-center">
              <a href="{{ route('pemilik.edit', $item['id']) }}" class="btn btn-sm btn-warning">Edit</a>
            </td>
          </tr>
        </table>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
