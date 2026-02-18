@extends('layouts.authentication')
@section('content')
    @switch($section)
        @case(1)
            @livewire('auth.login')
        @break

        @case(2)
        @break

        @case(3)
            @livewire('auth.forget-password')
        @break

        @case(4)
            @livewire('auth.forget-password-link', ['token' => $token])
        @break

        @default
    @endswitch
@endsection
