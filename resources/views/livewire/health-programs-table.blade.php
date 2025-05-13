<div>
    <table class="min-w-full bg-white rounded shadow">
        <thead>
        <tr class="bg-[#2C62EA] text-white text-left">
            <th class="p-3">Name</th>
            <th class="p-3">Description</th>
            <th class="p-3">Enrollments</th>
            <th class="p-3 text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($programs as $program)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">
                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-medium px-2 py-1 rounded mr-1">
                            {{ $program->name }}
                    </span>
                </td>
                <td class="p-3 text-gray-600 text-sm">{{ Str::limit($program->description, 300) }}</td>
                <td class="p-3">{{ $program->enrollments_count }}</td>
                <td class="p-3 text-center">
                    <a href="{{ route('health-programs.edit', $program->id) }}" 
                       class="text-blue-600 hover:text-blue-900" 
                       title="Edit Enrollments">
                       <i class="fas fa-edit"></i>
                    </a>
                    @can('delete program')
                        <form action="{{ route('health-programs.destroy', $program->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Delete Program" onclick="return confirm('Are you sure you want to delete this program?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
       
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">No health programs found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $programs->links() }}
    </div>
</div>
