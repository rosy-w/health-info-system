<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\HealthProgram;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $clientsCount = Client::count();
        $programsCount = HealthProgram::count();
        $enrollmentsCount = Enrollment::count();
        $recentClients = Client::latest()->take(5)->get();

        return view('dashboard', compact('clientsCount', 'programsCount', 'enrollmentsCount', 'recentClients'));
    }
}
