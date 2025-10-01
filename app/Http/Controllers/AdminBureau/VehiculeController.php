<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index() { return Vehicule::all(); }
    public function create() { /* return view('admin.vehicules.create'); */ }
    public function store(Request $request) {
        $request->validate([
            'matricule'=>'required|unique:vehicules,matricule',
            'type'=>'required|in:taxi,bus',
            'ligne'=>'nullable|string',
        ]);
        return Vehicule::create($request->all());
    }
    public function show(Vehicule $vehicule) { return $vehicule; }
    public function edit(Vehicule $vehicule) { /* return view('admin.vehicules.edit', compact('vehicule')); */ }
    public function update(Request $request, Vehicule $vehicule) {
        $request->validate([
            'matricule'=>'required|unique:vehicules,matricule,'.$vehicule->id,
            'type'=>'required|in:taxi,bus',
            'ligne'=>'nullable|string',
        ]);
        $vehicule->update($request->all());
        return $vehicule;
    }
    public function destroy(Vehicule $vehicule) { $vehicule->delete(); return response()->json(['message'=>'Véhicule supprimé']); }
}
