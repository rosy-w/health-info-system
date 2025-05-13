@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Health Programs</h1>
    @can('create program')
    <div class= "flex justify-end mb-4">    
    <a href="{{ route('health-programs.create') }}" class="bg-[#2C62EA] hover:bg-[#1a42ae] text-white px-5 py-2 rounded font-semibold shadow transition">+ Create Program</a>
    </div>
    @endcan
    @if (session('success'))
    {{--success message after creation/deletion of program --}}
        <div class="mb-6 max-w-3xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow">
            {{ session('success') }}
        </div>
    @endif
    @can('view program')
    @livewire('health-programs-table')
    @endcan
</div>
@endsection
