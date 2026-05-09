@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire(\App\Livewire\Admin\Order\Index::class)
        @break

        @case(2)
            @livewire(\App\Livewire\Admin\Order\Orders::class)
        @break

        @case(3)
            @livewire(\App\Livewire\Admin\Order\Estadisticas::class)
        @break

        @default
    @endswitch
@endsection
