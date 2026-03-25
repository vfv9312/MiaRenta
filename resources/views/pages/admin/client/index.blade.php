@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.client.clients')
        @break

        @case(2)
            @livewire('admin.client.client-form')
        @break

        @case(3)
            @livewire('admin.client.client-form', ['clientId' => $id])
        @break

        @default
    @endswitch
@endsection
