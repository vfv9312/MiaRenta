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
        @default

    @endswitch
@endsection
