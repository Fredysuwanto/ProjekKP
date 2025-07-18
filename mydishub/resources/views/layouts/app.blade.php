<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

<!-- Page Heading -->
@isset($header)
    <header style="background-image: url('{{ asset('images/header/header.png') }}'); background-size: cover; background-position: center;">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-white bg-black/50">
            {{ $header }}
        </div>
    </header>
@endisset


           <!-- Page Content -->
        <main>
          @yield('content')
        </main>

        </div>
    </body>
</html>
