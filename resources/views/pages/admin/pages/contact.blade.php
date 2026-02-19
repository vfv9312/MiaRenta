@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.pages.contac.index')
        @break

        @case(2)
            @livewire('admin.pages.contac.create')
        @break

        @case(3)
            @livewire('admin.pages.contac.edit')
        @break

        @default
    @endswitch
@endsection
