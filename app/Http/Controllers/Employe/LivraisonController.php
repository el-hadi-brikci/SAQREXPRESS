<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Livraison;
use App\Models\Vehicule;
use App\Models\Bureau;
use App\Models\Colis;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    public function index() { return Livraison::with(['vehicule','bureau','colis'])->get(); }
    public function create() { /* return view('admin.livraisons.create'); */ }
    public function store(Request $request) {
        $request->validate([
            'expediteur_nom'=>'required|string',
            'expediteur_tel'=>'required|string',
            'destinataire_nom'=>'required|string',
            'destinataire_tel'=>'required|string',
            'etat'=>'required|string',
            'vehicule_id'=>'required|exists:vehicules,id',
            'bureau_id'=>'required|exists:bureaux,id',
            'colis_id'=>'required|exists:colis,id',
        ]);
        return Livraison::create($request->all());
    }
    public function show(Livraison $livraison) { return $livraison->load(['vehicule','bureau','colis']); }
    public function edit(Livraison $livraison) { /* return view('admin.livraisons.edit', compact('livraison')); */ }
    public function update(Request $request, Livraison $livraison) {
        $request->validate([
            'expediteur_nom'=>'required|string',
            'expediteur_tel'=>'required|string',
            'destinataire_nom'=>'required|string',
            'destinataire_tel'=>'required|string',
            'etat'=>'required|string',
            'vehicule_id'=>'required|exists:vehicules,id',
            'bureau_id'=>'required|exists:bureaux,id',
            'colis_id'=>'required|exists:colis,id',
        ]);
        $livraison->update($request->all());
        return $livraison;
    }
    public function destroy(Livraison $livraison) { $livraison->delete(); return response()->json(['message'=>'Livraison supprim\u00e9e']); }
}
