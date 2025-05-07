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
        'email' => 'nullable|email|unique:clients,email',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'dob' => 'nullable|date',
        'health_program_id' => 'required|array',
        'health_program_id.*' => 'exists:health_programs,id',
        'start_date' => 'required|array',
        'end_date' => 'required|array',
        'start_date.*' => 'required|date',
        'end_date.*' => 'required|date|after_or_equal:start_date.*',
    ]);

    $client = Client::create([
        'name' => $data['name'],
        'email' => $data['email'] ?? null,
        'phone' => $data['phone'] ?? null,
        'address' => $data['address'] ?? null,
        'dob' => $data['dob'] ?? null,
    ]);

    // Create enrollments one by one
    foreach ($data['health_program_id'] as $programId) {
        \App\Models\Enrollment::create([
            'client_id' => $client->id,
            'health_program_id' => $programId,
            'start_date' => $data['start_date'][$programId],
            'end_date' => $data['end_date'][$programId],
            'user_id' => auth()->id(), // if you want to track the doc who enrolled them
        ]);
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
        // Load full enrollments with healthProgram relation for the Blade dynamic inputs
        $enrollments = $client->enrollments()->with('healthProgram')->get();
        $enrolledProgramIds = $client->enrollments->pluck('health_program_id')->toArray();

        return view('clients.edit', compact('client', 'programs', 'clientPrograms','enrollments','enrolledProgramIds'));
    }

    public function update(Request $request, Client $client)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|unique:clients,email,' . $client->id,
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'dob' => 'nullable|date',
        'health_program_id' => 'required|array',
        'health_program_id.*' => 'exists:health_programs,id',
        'start_date' => 'required|array',
        'end_date' => 'required|array',
        'start_date.*' => 'required|date',
        'end_date.*' => 'required|date|after_or_equal:start_date.*',
    ]);

    // Update client info
    $client->update([
        'name' => $data['name'],
        'email' => $data['email'] ?? null,
        'phone' => $data['phone'] ?? null,
        'address' => $data['address'] ?? null,
        'dob' => $data['dob'] ?? null,
    ]);

    // Handle enrollments:

    // 1) Remove enrollments for programs no longer selected
    $client->enrollments()->whereNotIn('health_program_id', $data['health_program_id'])->delete();

    // 2) Loop over selected programs ($programId) and update or create enrollment records with new dates
    foreach ($data['health_program_id'] as $programId) {
        $start = $data['start_date'][$programId];
        $end = $data['end_date'][$programId];

        $enrollment = $client->enrollments()->where('health_program_id', $programId)->first();

        if ($enrollment) {
            // update existing enrollment
            $enrollment->update([
                'start_date' => $start,
                'end_date' => $end,
            ]);
        } else {
            // new enrollment record
            $client->enrollments()->create([
                'health_program_id' => $programId,
                'start_date' => $start,
                'end_date' => $end,
                'user_id' => auth()->id(),
            ]);
        }
    }

    return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
}

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
