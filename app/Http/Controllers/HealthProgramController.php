<?php

namespace App\Http\Controllers;

use App\Models\HealthProgram;
use Illuminate\Http\Request;

class HealthProgramController extends Controller
{
    public function index()
    {
        $programs = HealthProgram::withCount('enrollments')->paginate(10);
        return view('health-programs.index', compact('programs'));
    }

    public function create()
    {
        return view('health-programs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        HealthProgram::create($data);

        return redirect()->route('health-programs.index')->with('success', 'Health Program created successfully.');
    }

    public function edit(HealthProgram $healthProgram)
    {
        return view('health-programs.edit', compact('healthProgram'));
    }

    public function update(Request $request, HealthProgram $healthProgram)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $healthProgram->update($data);

        return redirect()->route('health-programs.index')->with('success', 'Health Program updated successfully.');
    }

    public function destroy(HealthProgram $healthProgram)
    {
        $healthProgram->delete();

        return redirect()->route('health-programs.index')->with('success', 'Health Program deleted successfully.');
    }
}
