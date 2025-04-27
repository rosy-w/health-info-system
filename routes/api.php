<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\HealthProgramController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::apiResource('clients', ClientController::class);
Route::apiResource('programs', HealthProgramController::class);
Route::apiResource('enrollments', EnrollmentController::class);


//login for issuing tokens
Route::post('/login', function (Request $request) {
    // Validate credentials
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Authenticated...
    $user = Auth::user();
    $token = $user->createToken('api-token')->plainTextToken;
    return response()->json(['token' => $token]);
});

//return authenticated user's info'
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
