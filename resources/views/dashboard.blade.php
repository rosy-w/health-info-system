@extends('layouts.app')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <h2 class="text-2xl font-bold text-[#2C62EA]">Dashboard</h2>
    <div class="flex  gap-4">
    <a href="{{ route('clients.create') }}" class="bg-[#2C62EA] hover:bg-[#1a42ae] text-white px-5 py-2 rounded font-semibold shadow transition">+ Create Client</a>
    <a href="{{ route('health-programs.create') }}" class="bg-white hover:bg-[#388e3c] text-[#2C62EA] px-5 py-2 rounded font-semibold shadow transition">+ Create Program</a>
</div>
</div>

{{-- Widget Row --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Total Clients --}}
    <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border">
        <div class="text-[#2C62EA] text-3xl font-bold mb-2">{{ $clientsCount }}</div>
        <div class="text-gray-600 font-semibold">Total Clients</div>
    </div>
    {{-- Total Health Programs --}}
    <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border">
        <div class="text-[#66BB6A] text-3xl font-bold mb-2">{{ $programsCount }}</div>
        <div class="text-gray-600 font-semibold">Health Programs</div>
    </div>
    {{-- Total Enrollments --}}
    <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition border">
        <div class="text-[#FFA726] text-3xl font-bold mb-2">{{ $enrollmentsCount }}</div>
        <div class="text-gray-600 font-semibold">Total Enrollments</div>
    </div>
</div>

{{--   Enroll  --}}
 {{-- <div class="mb-8 flex flex-wrap gap-4">
    <a href="{{ route('enrollments.create') }}" class="bg-[#FFA726] hover:bg-[#fb8c00] text-white px-5 py-2 rounded font-semibold shadow transition">+ Enroll Client</a>
</div> --}}

{{-- Recent Clients Widget --}}
<div class="bg-white p-6 rounded-lg shadow border">
    <h3 class="text-lg font-bold mb-4 text-[#2C62EA]">Recent Clients</h3>
    <ul class="divide-y">
        @foreach($recentClients as $client)
            <li class="flex justify-between py-2">
                <span>{{ $client->name }}</span>
                <span class="text-sm text-gray-500">{{ $client->created_at->format('d M Y') }}</span>
            </li>
        @endforeach
    </ul>
</div>
@endsection
