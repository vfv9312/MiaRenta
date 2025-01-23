@extends('layouts.landing-page')
@section('content')
    @switch($section)
        @case(1)
            @livewire('dashboard.home')
            @break
        @case(2)
            
            @break
        @default
            
    @endswitch
@endsection