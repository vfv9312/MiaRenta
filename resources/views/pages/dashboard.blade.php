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
            @livewire('dashboard.ListaProductos')
        @break

        @case(4)
            @livewire('dashboard.Orden')
        @break

        @case(5)
            @livewire('dashboard.Nosotros')
        @break

        @case(6)
            @livewire('dashboard.Politicas')
        @break

        @case(7)
            @livewire('dashboard.Reclamaciones')
        @break

        @case(8)
            @livewire('dashboard.Factura')
        @break

        @default
            @livewire('dashboard.Noencontrado')
    @endswitch
@endsection
