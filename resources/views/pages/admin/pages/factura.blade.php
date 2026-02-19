@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.pages.factura.index')
        @break

        @case(2)
            @livewire('admin.pages.factura.create')
        @break

        @case(3)
            @livewire('admin.pages.factura.edit')
        @break

        @default
    @endswitch
@endsection
