@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.pages.us.index')
        @break

        @case(2)
            @livewire('admin.pages.us.create')
        @break

        @case(3)
            @livewire('admin.pages.us.edit')
        @break

        @default
    @endswitch
@endsection
