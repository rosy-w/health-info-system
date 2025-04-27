<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Http\Resources\EnrollmentResource;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['client', 'healthProgram'])->get();
        return EnrollmentResource::collection($enrollments);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'         => 'required|exists:clients,id',
            'health_program_id' => 'required|exists:health_programs,id',
            'start_date'        => 'required|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
        ]);

        // Attach "user_id" (doctor) if you need to:
        $data['user_id'] = auth()->id();

        $enrollment = Enrollment::create($data);
        $enrollment->load(['client', 'healthProgram']);
        return new EnrollmentResource($enrollment);
    }

    public function show($id)
    {
        $enrollment = Enrollment::with(['client', 'healthProgram'])->findOrFail($id);
        return new EnrollmentResource($enrollment);
    }

    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $data = $request->validate([
            'client_id'         => 'sometimes|exists:clients,id',
            'health_program_id' => 'sometimes|exists:health_programs,id',
            'start_date'        => 'sometimes|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
        ]);
        $enrollment->update($data);
        $enrollment->load(['client', 'healthProgram']);
        return new EnrollmentResource($enrollment);
    }

    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();
        return response()->json(['message' => 'Enrollment deleted']);
    }
}
