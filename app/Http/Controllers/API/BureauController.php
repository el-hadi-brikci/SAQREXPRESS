<?php

namespace App\Http\Controllers;

use App\Models\Bureau;
use App\Models\Region;
use Illuminate\Http\Request;

class BureauController extends Controller
{
    public function index() { return Bureau::with('region')->get(); }
    public function create() { /* return view('admin.bureaux.create', ['regions' => Region::all()]); */ }
    public function store(Request $request) {
        $request->validate([
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'region_id' => 'required|exists:regions,id',
        ]);
        return Bureau::create($request->only('nom', 'adresse', 'region_id'));
    }
    public function show(Bureau $bureau) { return $bureau->load('region'); }
    public function edit(Bureau $bureau) { /* return view('admin.bureaux.edit', compact('bureau')); */ }
    public function update(Request $request, Bureau $bureau) {
        $request->validate([
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'region_id' => 'required|exists:regions,id',
        ]);
        $bureau->update($request->only('nom', 'adresse', 'region_id'));
        return $bureau;
    }
    public function destroy(Bureau $bureau) { $bureau->delete(); return response()->json(['message' => 'Bureau supprimé']); }
}
