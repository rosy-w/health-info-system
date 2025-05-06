@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6 text-[#2C62EA]">Add New Client</h1>

    <form method="POST" action="{{ route('clients.store') }}" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="flex space-x-4 mb-4">
            <div class="flex-1 px-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input id="name" name="name" type="text" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex-1 px-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input id="phone" name="phone" type="text"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
            @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input id="dob" name="dob" type="date"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
            @error('dob') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input id="address" name="address" type="text"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
            @error('address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <input id="city" name="city" type="text"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
            @error('city') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="health_programs" class="block text-sm font-medium text-gray-700">
                Health Programs
            </label>
            <select id="health_programs" name="health_program_id[]" multiple
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]"
                    size="5">
                <option value="" disabled>Select one or more programs</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
            @error('health_program_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Container for enrollment inputs for each selected program -->
        <div id="enrollments" class="space-y-4 mt-6"></div>

        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-[#2C62EA] border border-transparent rounded-md font-semibold text-white hover:bg-[#244dcc] transition">
                Save Client
            </button>
        </div>
    </form>
</div>
<script>
document.getElementById('health_programs').addEventListener('change', function() {
    const container = document.getElementById('enrollments');
    container.innerHTML = ''; // Clear existing inputs

    // Get selected options
    const selectedOptions = Array.from(this.selectedOptions);

    selectedOptions.forEach(option => {
        const programId = option.value;
        const programName = option.text;

        // Create a wrapper div for the program dates
        const wrapper = document.createElement('div');
        wrapper.classList.add('border', 'p-4', 'rounded-md', 'shadow-sm', 'bg-white');

        // Program name (readonly or heading)
        const heading = document.createElement('h3');
        heading.textContent = programName;
        heading.classList.add('text-lg', 'font-semibold', 'mb-2');
        wrapper.appendChild(heading);

        // Start date input
        const startLabel = document.createElement('label');
        startLabel.setAttribute('for', `start_date_${programId}`);
        startLabel.textContent = 'Start Date';
        startLabel.classList.add('block', 'text-sm', 'font-medium', 'text-gray-700');
        wrapper.appendChild(startLabel);

        const startInput = document.createElement('input');
        startInput.setAttribute('type', 'date');
        startInput.setAttribute('id', `start_date_${programId}`);
        startInput.setAttribute('name', `start_date[${programId}]`);
        startInput.classList.add('mt-1', 'block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:ring-[#2C62EA]', 'focus:border-[#2C62EA]', 'mb-4');
        wrapper.appendChild(startInput);

        // End date input
        const endLabel = document.createElement('label');
        endLabel.setAttribute('for', `end_date_${programId}`);
        endLabel.textContent = 'End Date';
        endLabel.classList.add('block', 'text-sm', 'font-medium', 'text-gray-700');
        wrapper.appendChild(endLabel);

        const endInput = document.createElement('input');
        endInput.setAttribute('type', 'date');
        endInput.setAttribute('id', `end_date_${programId}`);
        endInput.setAttribute('name', `end_date[${programId}]`);
        endInput.classList.add('mt-1', 'block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:ring-[#2C62EA]', 'focus:border-[#2C62EA]');
        wrapper.appendChild(endInput);

        // Append wrapper to container
        container.appendChild(wrapper);
    });
});
</script>
@endsection
