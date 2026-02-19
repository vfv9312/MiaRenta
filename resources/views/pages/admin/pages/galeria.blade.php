@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.pages.galeria.index')
        @break

        @case(2)
            @livewire('admin.pages.galeria.create')
        @break

        @case(3)
            @livewire('admin.pages.galeria.edit')
        @break

        @default
    @endswitch
@endsection
