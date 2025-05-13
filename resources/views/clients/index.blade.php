@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Clients</h1>
    <div class= "flex justify-end mb-4">    
    <a href="{{ route('clients.create') }}" class="bg-[#2C62EA] hover:bg-[#1a42ae] text-white px-5 py-2 rounded font-semibold shadow transition">+ Create Client</a>
    </div>
    @if (session()->has('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        class="mb-6 max-w-3xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow"
        role="alert"
    >
        {{ session('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        class="mb-6 max-w-3xl mx-auto bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow"
        role="alert"
    >
        {{ session('error') }}
    </div>
@endif
    @can('view client')
    @livewire('clients-table')
    @endcan
</div>
@endsection
