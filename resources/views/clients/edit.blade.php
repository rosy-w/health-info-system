@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6 text-[#2C62EA]">Edit Client</h1>

    <form method="POST" action="{{ route('clients.update', $client->id) }}" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="flex space-x-4 mb-4">
            <div class="flex-1 px-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input id="name" name="name" type="text" required
                       value="{{ old('name', $client->name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex-1 px-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email"
                       value="{{ old('email', $client->email) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input id="phone" name="phone" type="text"
                   value="{{ old('phone', $client->phone) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
            @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input id="dob" name="dob" type="date"
                   value="{{ old('dob', $client->dob ? $client->dob->format('Y-m-d') : '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
            @error('dob') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input id="address" name="address" type="text"
                   value="{{ old('address', $client->address) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
            @error('address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <input id="city" name="city" type="text"
                   value="{{ old('city', $client->city) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
            @error('city') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Health Programs multi-select -->
        <div class="mb-4">
            <label for="health_programs" class="block text-sm font-medium text-gray-700">
                Health Programs
            </label>
            <select id="health_programs" name="health_program_id[]" multiple size="5"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
                <option value="" disabled>Select one or more programs</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}"
                        {{ (in_array($program->id, old('health_program_id', $enrolledProgramIds))) ? 'selected' : '' }}>
                        {{ $program->name }}
                    </option>
                @endforeach
            </select>
            @error('health_program_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Enrollment inputs generated dynamically -->
        <div id="enrollments" class="space-y-4 mt-6">
            @foreach($enrollments as $enrollment)
                <div class="border p-4 rounded-md shadow-sm bg-white">
                    <h3 class="text-lg font-semibold mb-2">{{ $enrollment->healthProgram->name }}</h3>

                    <label for="start_date_{{ $enrollment->health_program_id }}" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input id="start_date_{{ $enrollment->health_program_id }}" 
                           name="start_date[{{ $enrollment->health_program_id }}]" 
                           type="date" required
                           value="{{ old('start_date.' . $enrollment->health_program_id, $enrollment->start_date ? $enrollment->start_date->format('Y-m-d') : '') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA] mb-4">

                    <label for="end_date_{{ $enrollment->health_program_id }}" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input id="end_date_{{ $enrollment->health_program_id }}" 
                           name="end_date[{{ $enrollment->health_program_id }}]" 
                           type="date" required
                           value="{{ old('end_date.' . $enrollment->health_program_id, $enrollment->end_date ? $enrollment->end_date->format('Y-m-d') : '') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
                </div>
            @endforeach
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-[#2C62EA] border border-transparent rounded-md font-semibold text-white hover:bg-[#244dcc] transition">
                Update Client
            </button>
        </div>
    </form>
</div>
@php
    $existingEnrollments = $enrollments->mapWithKeys(function ($enrollment) {
        return [
            $enrollment->health_program_id => [
                'start_date' => $enrollment->start_date ? $enrollment->start_date->format('Y-m-d') : '',
                'end_date' => $enrollment->end_date ? $enrollment->end_date->format('Y-m-d') : '',
                'program_name' => $enrollment->healthProgram->name,
            ],
        ];
    });
@endphp
<script>
    const healthProgramsSelect = document.getElementById('health_programs');
    const enrollmentsContainer = document.getElementById('enrollments');
    const existingEnrollments = @json($existingEnrollments);

    function renderEnrollmentInputs() {
        enrollmentsContainer.innerHTML = ''; // Clear current enrollments

        const selectedOptions = Array.from(healthProgramsSelect.selectedOptions);

        selectedOptions.forEach(option => {
            const programId = option.value;
            const programName = option.text;

            // Use existing data if available or defaults
            const existingData = existingEnrollments[programId] || {
                start_date: '',
                end_date: '',
                program_name: programName,
            };

            // Create container div
            const div = document.createElement('div');
            div.classList.add('border', 'p-4', 'rounded-md', 'shadow-sm', 'bg-white');

            // Heading (program name)
            const h3 = document.createElement('h3');
            h3.textContent = existingData.program_name;
            h3.classList.add('text-lg', 'font-semibold', 'mb-2');
            div.appendChild(h3);

            // Start date label and input
            const startLabel = document.createElement('label');
            startLabel.setAttribute('for', `start_date_${programId}`);
            startLabel.textContent = 'Start Date';
            startLabel.classList.add('block', 'text-sm', 'font-medium', 'text-gray-700');
            div.appendChild(startLabel);

            const startInput = document.createElement('input');
            startInput.type = 'date';
            startInput.id = `start_date_${programId}`;
            startInput.name = `start_date[${programId}]`;
            startInput.required = true;
            startInput.value = existingData.start_date;
            startInput.classList.add(
                'mt-1', 'block', 'w-full', 'rounded-md', 'border-gray-300',
                'shadow-sm', 'focus:ring-[#2C62EA]', 'focus:border-[#2C62EA]', 'mb-4'
            );
            div.appendChild(startInput);

            // End date label and input
            const endLabel = document.createElement('label');
            endLabel.setAttribute('for', `end_date_${programId}`);
            endLabel.textContent = 'End Date';
            endLabel.classList.add('block', 'text-sm', 'font-medium', 'text-gray-700');
            div.appendChild(endLabel);

            const endInput = document.createElement('input');
            endInput.type = 'date';
            endInput.id = `end_date_${programId}`;
            endInput.name = `end_date[${programId}]`;
            endInput.required = true;
            endInput.value = existingData.end_date;
            endInput.classList.add(
                'mt-1', 'block', 'w-full', 'rounded-md', 'border-gray-300',
                'shadow-sm', 'focus:ring-[#2C62EA]', 'focus:border-[#2C62EA]'
            );
            div.appendChild(endInput);

            // Append whole enrollment div to container
            enrollmentsContainer.appendChild(div);
        });
    }

    // Initial rendering of enrollments on page load (for edit forms)
    document.addEventListener('DOMContentLoaded', renderEnrollmentInputs);

    // Re-render enrollments whenever user changes selection
    healthProgramsSelect.addEventListener('change', renderEnrollmentInputs);
</script>
@endsection
