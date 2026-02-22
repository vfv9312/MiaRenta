@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.pages.home.banner.index')
        @break

        @case(2)
            @livewire('admin.pages.home.banner.create')
        @break

        @case(3)
            @livewire('admin.pages.home.banner.edit')
        @break

        @default
    @endswitch
@endsection
