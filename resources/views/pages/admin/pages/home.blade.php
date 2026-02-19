@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.pages.home.index')
        @break

        @case(2)
            @livewire('admin.pages.home.create')
        @break

        @case(3)
            @livewire('admin.pages.home.edit')
        @break

        @default
    @endswitch
@endsection
