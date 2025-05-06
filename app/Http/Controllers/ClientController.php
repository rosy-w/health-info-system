<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\HealthProgram;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $programs = HealthProgram::all();
        return view('clients.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'dob' => 'nullable|date',
            'programs' => 'array|exists:health_programs,id',
        ]);

        $client = Client::create($data);
        if (isset($data['programs'])) {
            $client->healthPrograms()->sync($data['programs']);
        }

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        $client->load('healthPrograms');
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        $programs = HealthProgram::all();
        $clientPrograms = $client->healthPrograms->pluck('id')->toArray();
        return view('clients.edit', compact('client', 'programs', 'clientPrograms'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'dob' => 'nullable|date',
            'programs' => 'array|exists:health_programs,id',
        ]);

        $client->update($data);
        if (isset($data['programs'])) {
            $client->healthPrograms()->sync($data['programs']);
        }

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
