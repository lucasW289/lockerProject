<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Application')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @livewireStyles
    @yield('styles')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    @include('components.header')

    <div class="container">
        @yield('content')
    </div>

    @include('components.footer')

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @livewireScripts
</body>
</html>
<script src="https://cdn.tailwindcss.com"></script>

