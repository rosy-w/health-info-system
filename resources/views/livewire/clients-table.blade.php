<div>
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-[#2C62EA] text-white">
                <th class="p-2 text-left">Name</th>
                <th class="p-2 text-left">Health Program(s)</th>
                <th class="p-2 text-left">Email</th>
                <th class="p-2 text-left">Registered</th>
                <th class="p-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $client->name }}</td>
                <td class="p-3">
                    @forelse($client->healthPrograms as $program)
                        <span class="inline-block bg-blue-100 text-blue-700 text-xs font-medium px-2 py-1 rounded mr-1">
                            {{ $program->name }}
                        </span>
                    @empty
                        <span class="text-gray-400 text-sm">None</span>
                    @endforelse
                </td>
                <td class="p-3">{{ $client->email }}</td>
                <td class="p-3 text-sm text-gray-500">{{ $client->created_at->format('d M Y') }}</td>
                <td>
                    <a class="btn btn-sm" href="{{ route('clients.edit', $client) }}" title= "Edit Client">
                        <i class="p-2 fas fa-edit"></i>
                    </a>
                    <a class="btn btn-sm" href="{{ route('clients.show', $client->id) }}" title= "View Client">
                        <i class="p-2 fas fa-eye"></i>
                    </a>
                    @can('delete client')
                         <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Delete Client" onclick="return confirm('Are you sure you want to delete this client?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-2 text-gray-500 text-center">No clients found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $clients->links() }}
    </div>
</div>
