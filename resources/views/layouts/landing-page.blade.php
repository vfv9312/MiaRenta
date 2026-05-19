<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/storage/Login/logo.jpeg') }}" type="image/x-icon">

    <title>{{ config('app.name') }} - Renta para Eventos en Tuxtla</title>

    <!-- Meta Tags para SEO -->
    <meta name="description"
        content="Mía Renta - Renta de sillas, mesas, mantelería y cristalería para eventos en Tuxtla Gutiérrez y Chiapas. Especialistas en bodas, XV años, cumpleaños y reuniones empresariales.">
    <meta name="keywords"
        content="renta de sillas, renta de mesas, mantelería, cristalería, eventos, bodas, XV años, cumpleaños, reuniones, Tuxtla Gutiérrez, Chiapas, Mía Renta">
    <meta name="author" content="Vladimir Farrera">

    <!-- Open Graph / Facebook / Instagram -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:title" content="Mía Renta - Todo para tu Evento">
    <meta property="og:description"
        content="Renta de sillas, mesas y mantelería para bodas, XV años y reuniones en Tuxtla Gutiérrez.">
    <meta property="og:image" content="{{ asset('/storage/Login/logo.jpeg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ config('app.url') }}">
    <meta property="twitter:title" content="Mía Renta - Todo para tu Evento">
    <meta property="twitter:description"
        content="Renta de sillas, mesas y mantelería para bodas, XV años y reuniones en Tuxtla Gutiérrez.">
    <meta property="twitter:image" content="{{ asset('/storage/Login/logo.jpeg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

    {{-- JSON-LD --}}
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Mía Renta",
  "url": "{{ config('app.url') }}",
  "logo": "{{ asset('/storage/Login/logo.jpeg') }}",
  "description": "Empresa tuxtleca con más de una década de experiencia en renta de mobiliario para eventos.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Calle Aguiluchos #291, Fracc. Las Aguilas",
    "addressLocality": "Tuxtla Gutiérrez",
    "addressRegion": "Chiapas",
    "postalCode": "29049",
    "addressCountry": "MX"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+52-961-458-5559",
    "contactType": "customer service",
    "availableLanguage": "Spanish"
  },
  "sameAs": [
    "https://www.facebook.com/miarenta"
  ],
  "knowsAbout": ["Renta de sillas", "Renta de mesas", "Mobiliario para eventos", "Mantelería"],
  "mission": "Proveer mobiliario de alta gama y servicios excepcionales que faciliten la realización de eventos espectaculares, superando siempre.",
  "vision": "Ser la empresa líder en renta de mobiliario en Chiapas, reconocida por nuestra innovación constante, elegancia en diseños y compromiso."
}
</script>

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
    @stack('css')
    @livewireStyles
</head>

<body class="flex flex-col min-h-screen antialiased">

    @include('partials.navbar')
    @include('partials.alerts')
    <div class="">
        @yield('content')
    </div>
    @include('partials.footer')

    @livewireScripts
    @stack('js')
</body>

</html>
