<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalHospitals = Hospital::count();
        $totalPatients = Patient::count();
        $recentHospitals = Hospital::latest()->take(5)->get();
        $recentPatients = Patient::with('hospital')->latest()->take(5)->get();

        return view('dashboard', compact('totalHospitals', 'totalPatients', 'recentHospitals', 'recentPatients'));
    }
}
