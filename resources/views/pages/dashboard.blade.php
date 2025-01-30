@extends('layouts.landing-page')
@section('content')
    @switch($section)
        @case(1)
            @livewire('dashboard.home')
            @break
        @case(2)
        @livewire('dashboard.ubicanos')
            @break
        @default

    @endswitch
@endsection
