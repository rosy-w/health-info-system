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
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('livewire.recent-clients-table', compact('clients'));
    }
}
