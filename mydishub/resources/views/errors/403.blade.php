@extends('layouts.app')

@section('content')
<div class="text-center mt-5">
  <h1 class="display-4">403</h1>
  <p class="lead">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
  <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
