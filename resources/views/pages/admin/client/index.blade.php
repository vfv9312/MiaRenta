@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.client.clients')
        @break

        @default
    @endswitch
@endsection
