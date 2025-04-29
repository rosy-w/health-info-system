<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\HealthProgram;

class LiveSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $clients = $programs = collect([]);

        if (strlen($query) > 1) {
            $clients = Client::where('name', 'like', "%{$query}%")->take(5)->get(['id','name']);
            $programs = HealthProgram::where('name', 'like', "%{$query}%")->take(5)->get(['id','name']);
        }

        return response()->json([
            'clients' => $clients,
            'programs' => $programs
        ]);
    }
}
