@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.dashboard')
        @break

        @case(2)
        @break

        @case(3)
        @break

        @default
    @endswitch
@endsection
