@extends('layout.main')

@section('title', 'pemilik')

@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Profil</h4>    
            <p class="card-description">
                Form Edit Profil
            </p>
                    @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form method="POST" action="{{route('profile.update') }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="name" id="name"
                    value="{{ old('name', auth()->user()->name) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" id="email"
                    value="{{ old('email', auth()->user()->email) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Password Baru -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-1">Password Baru</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti password.</p>
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Tombol Simpan -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan</button>
                <a href="{{url('dashboard')}}"></a>
            </div>
    </div>
</div>
@endsection