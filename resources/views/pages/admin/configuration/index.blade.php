@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.configuration.index')
        @break

        @case(2)
            @livewire('admin.configuration.colonias')
        @break

        @case(3)
            @livewire('admin.configuration.metodospago')
        @break

        @default
    @endswitch
@endsection
