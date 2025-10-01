<?php

namespace App\Http\Controllers;

use App\Models\Colis;
use App\Models\Bureau;
use App\Models\Client;
use Illuminate\Http\Request;

class ColisController extends Controller
{
    public function index() { return Colis::with(['bureau','client'])->get(); }
    public function create() { /* return view('admin.colis.create', ['bureaux'=>Bureau::all(),'clients'=>Client::all()]); */ }
    public function store(Request $request) {
        $request->validate([
            'code_suivi'=>'required|unique:colis,code_suivi',
            'description'=>'nullable|string',
            'poids'=>'nullable|numeric',
            'statut'=>'required|string',
            'bureau_id'=>'required|exists:bureaux,id',
            'client_id'=>'required|exists:clients,id',
        ]);
        return Colis::create($request->all());
    }
    public function show(Colis $coli) { return $coli->load(['bureau','client']); }
    public function edit(Colis $coli) { /* return view('admin.colis.edit', compact('coli')); */ }
    public function update(Request $request, Colis $coli) {
        $request->validate([
            'description'=>'nullable|string',
            'poids'=>'nullable|numeric',
            'statut'=>'required|string',
            'bureau_id'=>'required|exists:bureaux,id',
            'client_id'=>'required|exists:clients,id',
        ]);
        $coli->update($request->all());
        return $coli;
    }
    public function destroy(Colis $coli) { $coli->delete(); return response()->json(['message'=>'Colis supprimé']); }
}
