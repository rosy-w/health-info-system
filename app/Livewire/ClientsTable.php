<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;

class ClientsTable extends Component
{
    use WithPagination;

    public $search = '';

    public $confirmingClientDeletion = false;
    public $clientToDeleteId;

    protected $listeners = ['deleteClientConfirmed'];

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
    public function confirmClientDeletion($clientId)
    {
        $this->confirmingClientDeletion = true;
        $this->clientToDeleteId = $clientId;
    }

    public function deleteClientConfirmed()
    {
        $client = Client::find($this->clientToDeleteId);
        if ($client) {
            $client->delete();
            session()->flash('success', 'Client deleted successfully.');
            $this->resetPage();
        } else {
            session()->flash('error', 'Client not found.');
        }
        $this->confirmingClientDeletion = false;
        $this->clientToDeleteId = null;
    }

    public function cancelDelete()
    {
        $this->confirmingClientDeletion = false;
        $this->clientToDeleteId = null;
    }

}

