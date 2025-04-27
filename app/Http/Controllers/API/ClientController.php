<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use App\Http\Resources\ClientResource;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with('healthPrograms', 'enrollments')->get();
        return ClientResource::collection($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'id_number' => 'nullable|string',
            'email' => 'nullable|email|unique:clients',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'dob' => 'nullable|date',
        ]);

        $client = Client::create($data);

        //attaching the doctor that is logged in for the client
        $doctor = auth()->user(); // assumes API authentication
        $doctor->clients()->attach($client->id);

        $client->load('doctors');

        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //eager-load
         $client->load(['healthPrograms', 'enrollments', 'doctors']);

         return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'id_number' => 'nullable|string',
            'email' => 'nullable|email|unique:clients',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'dob' => 'nullable|date',
        ]);

        $client->update($data);

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['message' => 'Client deleted']);
    }
}
