@extends('layouts.landing-page')
@section('content')
    @switch($section)
        @case(1)
            @livewire('dashboard.Home')
        @break

        @case(2)
            @livewire('dashboard.Ubicanos')
        @break

        @case(3)
            @section('title', 'ELIGE TU MOBILIARIO | ' . config('app.name'))
        @section('meta_description',
            'Arma tu paquete ideal y obtén una cotización inmediata. ¡Haz que tu evento sea
            espectacular!')
            @livewire('dashboard.ListaProductos')
        @break

        @case(4)
            @section('title', 'ELIGE TU MOBILIARIO | ' . config('app.name'))
        @section('meta_description',
            'Arma tu paquete ideal y obtén una cotización inmediata. ¡Haz que tu evento sea
            espectacular!')
            @livewire('dashboard.Orden')
        @break

        @case(5)
            @livewire('dashboard.Nosotros')
        @break

        @case(6)
            @section('title', 'Politicas | ' . config('app.name'))
        @section('meta_description', 'Lee nuestras politicas de ' . config('app.name'))
        @livewire('dashboard.Politicas')
    @break

    @case(7)
        @section('title', 'Libro de Reclamaciones | ' . config('app.name'))
    @section('meta_description',
        'En Mía Renta tu opinión es muy importante. Déjanos tus comentarios, quejas o sugerencias
        en nuestro libro de reclamaciones en línea para mejorar nuestro servicio.')
        @livewire('dashboard.Reclamaciones')
    @break

    @case(8)
        @section('title', 'FACTURA | ' . config('app.name'))
    @section('meta_description', 'Solicita tu factura con nosotros, llena el formulario y listo.')
    @livewire('dashboard.Factura')
@break

@default
    @livewire('dashboard.Noencontrado')
@endswitch
@endsection
