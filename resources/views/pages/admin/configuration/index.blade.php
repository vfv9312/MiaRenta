@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.configuration.index')
        @break

        @case(2)
            @livewire('admin.configuration.colonias')
        @break

        @default
    @endswitch
@endsection
