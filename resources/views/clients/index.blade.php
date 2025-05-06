@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Clients</h1>
    @can('view client')
    @livewire('clients-table')
    @endcan
</div>
@endsection
