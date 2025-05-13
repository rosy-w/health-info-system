<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;


class RecentClientsTable extends Component
{
     public $search = '';
     //listeners for the delete conirmation modal
     protected $listeners = ['confirmDeleteClient'];

    public function render()
    {
        // You can change the take() value for more/less rows
        $clients = Client::query()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('livewire.recent-clients-table', compact('clients'));
    }
    public function confirmDeleteClient($clientId)
{
    $client = Client::find($clientId);

    if ($client) {
        $client->delete();
        session()->flash('success', 'Client deleted successfully.');
        $this->resetPage(); 
    } else {
        session()->flash('error', 'Client not found.');
    }
}
}
