@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-white rounded shadow">
    <h1 class="text-3xl font-bold mb-6 text-[#2C62EA]">{{ $client->name }}'s Profile</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Basic Info -->
        <div>
            <h2 class="text-xl font-semibold mb-3">Contact Information</h2>

            <p><strong>Email:</strong> {{ $client->email ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $client->phone ?? 'N/A' }}</p>
            <p><strong>Date of Birth:</strong> {{ $client->dob ? $client->dob->format('d M Y') : 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $client->address ?? 'N/A' }}</p>
            <p><strong>City:</strong> {{ $client->city ?? 'N/A' }}</p>
            <p><strong>Registered:</strong> {{ $client->created_at->format('d M Y') }}</p>
        </div>

        <!-- Enrolled Health Programs -->
        <div>
            <h2 class="text-xl font-semibold mb-3">Enrolled Health Program(s)</h2>

            @if($client->enrollments->count())
                <ul class="space-y-3">
                    @foreach($client->enrollments as $enrollment)
                        <li class="p-3 bg-gray-50 rounded shadow-sm">
                            <h3 class="font-bold">{{ $enrollment->healthProgram->name ?? 'Unnamed Program' }}</h3>
                            <p><strong>Start Date:</strong> {{ $enrollment->start_date ? $enrollment->start_date->format('d M Y') : 'N/A' }}</p>
                            <p><strong>End Date:</strong> {{ $enrollment->end_date ? $enrollment->end_date->format('d M Y') : 'N/A' }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">This client is not enrolled in any health programs.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('clients.index') }}"
       class="inline-block mt-6 px-5 py-2 bg-[#2C62EA] text-white rounded hover:bg-[#244dcc] transition font-semibold">
        Back to Clients List
    </a>
</div>
@endsection
