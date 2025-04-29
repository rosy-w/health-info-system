<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;


class RecentClientsTable extends Component
{
     public $search = '';

    public function render()
    {
        // You can change the take() value for more/less rows
        $clients = Client::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('livewire.recent-clients-table', compact('clients'));
    }
}
