<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::with('hospital');
        
        // Filter berdasarkan rumah sakit jika dipilih
        if ($request->filled('hospital_id')) {
            $query->where('hospital_id', $request->hospital_id);
        }
        
        $patients = $query->get();
        $hospitals = Hospital::all();
        
        return view('patients.index', compact('patients', 'hospitals'));
    }

    public function create()
    {
        $hospitals = Hospital::all();
        return view('patients.create', compact('hospitals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:20',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')
            ->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function show(Patient $patient)
    {
        $patient->load('hospital');
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $hospitals = Hospital::all();
        return view('patients.edit', compact('patient', 'hospitals'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:20',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')
            ->with('success', 'Pasien berhasil diperbarui.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil dihapus.'
        ]);
    }
}
