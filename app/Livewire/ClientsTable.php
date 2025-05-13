<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;

class ClientsTable extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $clients = Client::query()
            ->orderBy('name', 'asc')
            ->paginate(5);
         
        return view('livewire.clients-table', ['clients' => $clients]);
    }

}

