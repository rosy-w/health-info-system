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
                        <button type="button"
                                wire:click="confirmClientDeletion({{ $client->id }})"
                                class="text-red-600 hover:text-red-800"
                                title="Delete Client">
                            <i class="fas fa-trash"></i>
                        </button>
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
{{ $clients->links() }}

    <!-- Delete Confirmation Modal -->
    @if($confirmingClientDeletion)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded shadow-lg max-w-sm w-full p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
                    <i class="fas fa-exclamation-triangle text-orange-500 mr-2"></i>
                    Confirm Deletion
                </h2>
                <p>Are you sure you want to delete this client? This action cannot be undone.</p>
                <div class="mt-6 flex justify-end space-x-4">
                    <button wire:click="cancelDelete"
                            class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-700 transition">
                        Cancel
                    </button>
                    <button wire:click="deleteClientConfirmed"
                            class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white transition">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
