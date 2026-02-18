<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('/storage/Login/new-logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.js"></script>

    {{-- test --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- produccion --}}
    {{-- @php
        $cwd = getcwd();
        $cssName = basename(glob($cwd . '/build/assets/*.css')[0], '.css');
        $jsName = basename(glob($cwd . '/build/assets/*.js')[0], '.js');
        $css = asset('build/assets/' . $cssName . '.css');
        $js = asset('build/assets/' . $jsName . '.js');
    @endphp
    <link rel="stylesheet" href="{{ $css }}" id="css">
    <script src="{{ $js }}" id="js"></script> --}}
    {{-- Agrega aquí tus estilos comunes --}}
    @livewireStyles
</head>

<body class="antialiased dark:bg-dark">
    @include('partials.alerts')
    @yield('content')
    @livewireScripts
</body>

</html>
