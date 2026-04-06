@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.order.index')
        @break

        @case(2)
            @livewire('admin.order.orders')
        @break

        @case(3)
            @livewire('admin.order.estadisticas')
        @break

        @default
    @endswitch
@endsection
