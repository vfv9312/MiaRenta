@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.order.index')
        @break

        @default
    @endswitch
@endsection
