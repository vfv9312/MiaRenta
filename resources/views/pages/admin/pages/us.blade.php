@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.pages.us.index')
        @break

        @default
    @endswitch
@endsection
