@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-[#2C62EA] mb-6">Add New Health Program</h1>

    <form method="POST" action="{{ route('health-programs.store') }}" class="bg-white shadow rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Program Name</label>
            <input id="name" name="name" type="text" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#2C62EA] focus:border-[#2C62EA]"></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-[#2C62EA] border border-transparent rounded-md font-semibold text-white hover:bg-[#244dcc] transition">
                Save Program
            </button>
        </div>
    </form>
</div>
@endsection
