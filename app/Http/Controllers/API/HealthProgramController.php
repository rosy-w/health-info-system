<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HealthProgram;
use App\Http\Resources\HealthProgramResource;

class HealthProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = HealthProgram::with('clients')->get();
        return HealthProgramResource::collection($programs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $program = HealthProgram::create($data);

        $program->load('clients');
        return new HealthProgramResource($program);
    }

    /**
     * Display the specified resource.
     */
    public function show(HealthProgram $program)
    {
        //eager-load
         $program->load('clients');

         return new HealthProgramResource($program);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HealthProgram $program)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
        ]);

        $program->update($data);

        return new HealthProgramResource($program);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HealthProgram $program)
    {
        $program->delete();
        return response()->json(['message' => 'Health Program deleted']);
    }
}
