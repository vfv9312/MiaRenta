<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Acceso</title>
    <link rel="icon" href="{{ asset('/storage/Login/logo.jpeg') }}" type="image/x-icon">

    <!-- Meta Tags para SEO -->
    <meta name="description" content="Accede a Mía Renta para gestionar tus eventos: renta de sillas, mesas, mantelería y cristalería.">
    <meta name="author" content="Vladimir Farrera">

    <!-- Open Graph / Facebook / Instagram -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:title" content="Mía Renta - Todo para tu Evento">
    <meta property="og:description" content="Gestiona tus eventos con Mía Renta: renta de sillas, mesas y más en Tuxtla.">
    <meta property="og:image" content="{{ asset('/storage/Login/logo.jpeg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ config('app.url') }}">
    <meta property="twitter:title" content="Mía Renta - Todo para tu Evento">
    <meta property="twitter:description" content="Gestiona tus eventos con Mía Renta: renta de sillas, mesas y más en Tuxtla.">
    <meta property="twitter:image" content="{{ asset('/storage/Login/logo.jpeg') }}">

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
