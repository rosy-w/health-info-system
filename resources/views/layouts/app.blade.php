<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </head>
    <body class="bg-[#F5F7FA] text-[#333]">
<div class="min-h-screen flex">
    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md hidden md:flex flex-col">
        <div class="h-16 flex items-center justify-center border-b">
            <span class="text-[#3D518C] font-bold text-lg">Health System</span>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}"
               class="flex items-center px-4 py-3 rounded hover:bg-[#ABD2FA] transition">
                <i class="fa-solid fa-house text-[#3D518C] text-lg mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('clients.index') }}"
               class="flex items-center px-4 py-3 rounded hover:bg-[#ABD2FA] transition">
                <i class="fa-solid fa-users text-[#3D518C] text-lg mr-3"></i>
                Clients
            </a>
            <a href="{{ route('health-programs.index') }}"
               class="flex items-center px-4 py-3 rounded hover:bg-[#ABD2FA] transition">
                <i class="fa-solid fa-notes-medical text-[#3D518C] text-lg mr-3"></i>
                Health Programs
            </a>
            <a href="{{ route('enrollments.index') }}"
               class="flex items-center px-4 py-3 rounded hover:bg-[#ABD2FA] transition">
                <i class="fa-solid fa-clipboard text-[#3D518C] text-lg mr-3"></i>
                Enrollments
            </a>
        </nav>
    </aside>
    <div class="flex-1 min-h-screen flex flex-col">
        {{-- Navbar --}}
        <header class="bg-[#3D518C] text-white p-4 shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                <!-- Alpine.js livesearch -->
                <div x-data="searchDropdown()" class="relative w-full max-w-md">
                    <input
                        type="text"
                        x-model="query"
                        @input.debounce.300ms="search"
                        @focus="open = true"
                        @click.outside="open = false"
                        placeholder="Search clients or programs..."
                        class="w-full px-4 py-2 rounded-l bg-white text-[#333] focus:outline-none focus:ring-2 focus:ring-[#29B6F6]">
                    <!-- Dropdown Results -->
                    <div
                        x-show="open && (results.clients.length || results.programs.length || query.length > 0)"
                        @mousedown.away="open = false"
                        class="absolute left-0 z-50 mt-2 w-full bg-white rounded shadow max-h-80 overflow-auto border border-gray-200">
                        <template x-if="query && !results.clients.length && !results.programs.length">
                            <div class="p-4 text-gray-400 text-sm">No results found.</div>
                        </template>

                        <template x-if="results.clients.length">
                            <div>
                                <div class="px-3 py-2 border-b font-semibold text-[#3D518C]">Clients</div>
                                <template x-for="client in results.clients" :key="client.id">
                                    <a
                                        :href="`/clients/${client.id}`"
                                        class="block hover:bg-[#ABD2FA] px-4 py-2 border-b last:border-b-0 transition text-[#3D518C]"
                                        x-text="client.name"
                                        @click="open = false"
                                    ></a>
                                </template>
                            </div>
                        </template>

                        <template x-if="results.programs.length">
                            <div>
                                <div class="px-3 py-2 border-b font-semibold text-[#3D518C]">Health Programs</div>
                                <template x-for="program in results.programs" :key="program.id">
                                    <a
                                        :href="`/health-programs/${program.id}`"
                                        class="block hover:bg-[#ABD2FA] px-4 py-2 border-b last:border-b-0 transition text-[#3D518C]"
                                        x-text="program.name"
                                        @click="open = false"
                                    ></a>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
                <div>
                    <span class="mr-4">{{ Auth::user()->name ?? 'Doctor' }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-[#FFA726] px-3 py-1 rounded hover:bg-[#fb8c00]">
                        <i class="fa-solid fa-logout text-[#3D518C] text-lg mr-3"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</div>
<script>
function searchDropdown() {
    return {
        query: '',
        open: false,
        results: {clients: [], programs: []},
        search() {
            if(this.query.length < 1) {
                this.results = {clients: [], programs: []};
                return;
            }
            fetch(`/api/livesearch?q=${encodeURIComponent(this.query)}`)
                .then(res => res.json())
                .then(data => {
                    this.results = {
                        clients: data.clients.map(c => ({
                            id: c.id,
                            name: c.name,
                            url: `/clients/${c.id}`
                        })),
                        programs: data.programs.map(p => ({
                            id: p.id,
                            name: p.name,
                            url: `/health-programs/${p.id}`
                        }))
                    };
                    this.open = true;
                });
        }
    }
}
</script>
@livewireScripts
</body>
</html>
