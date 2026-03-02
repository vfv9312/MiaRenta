@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.pages.politica.index')
        @break

        @default
    @endswitch
@endsection
