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
                <td class="p-2">{{ $client->name }}</td>
                <td class="p-2">
                    @forelse($client->healthPrograms as $program)
                        <span class="inline-block bg-blue-100 text-blue-700 text-xs font-medium px-2 py-1 rounded mr-1">
                            {{ $program->name }}
                        </span>
                    @empty
                        <span class="text-gray-400 text-sm">None</span>
                    @endforelse
                </td>
                <td class="p-2">{{ $client->email }}</td>
                <td class="p-2 text-sm text-gray-500">{{ $client->created_at->format('d M Y') }}</td>
                <td>
                    <a class="btn btn-sm btn-dark" href="" title= "Edit Client">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-2 text-gray-500 text-center">No clients found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
