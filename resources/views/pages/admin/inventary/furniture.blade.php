@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.inventary.colors')
        @break

        @case(2)
            @livewire('admin.inventary.types')
        @break

        @case(3)
            @livewire('admin.inventary.catalog-types')
        @break

        @case(4)
            @livewire('admin.inventary.categorias')
        @break

        @default
    @endswitch
@endsection
