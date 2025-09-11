<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::all();
        return view('hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('hospitals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
        ]);

        Hospital::create($request->all());

        return redirect()->route('hospitals.index')
            ->with('success', 'Rumah sakit berhasil ditambahkan.');
    }

    public function show(Hospital $hospital)
    {
        return view('hospitals.show', compact('hospital'));
    }

    public function edit(Hospital $hospital)
    {
        return view('hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
        ]);

        $hospital->update($request->all());

        return redirect()->route('hospitals.index')
            ->with('success', 'Rumah sakit berhasil diperbarui.');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();

        return redirect()->route('hospitals.index')
            ->with('success', 'Rumah sakit berhasil dihapus.');
    }
}
