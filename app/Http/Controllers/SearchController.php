<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\HealthProgram;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $clients = collect();
        $programs = collect();

        if ($query) {
            // Adjust as needed: Here . . .
            $clients = Client::where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('phone', 'like', "%{$query}%")
                ->get();

            $programs = HealthProgram::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->get();
        }

        return view('search.results', [
            'query' => $query,
            'clients' => $clients,
            'programs' => $programs,
        ]);
    }
}
