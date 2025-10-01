<?php

namespace App\Http\Controllers\AdminRegion;

use App\Models\Bureau;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BureauController extends \App\Http\Controllers\Controller
{
    /**
     * Liste des bureaux
     */
    public function index()
    {
    $regionId = Auth::user()->region_id;
        $bureaux = Bureau::with('region')->where('region_id', $regionId)->get();
        return view('adminRegion.bureau.index', compact('bureaux'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        // La région courante
        $regionId = Auth::user()->region_id;
        return view('adminRegion.bureau.create', compact('regionId'));
    }

    /**
     * Enregistrer un nouveau bureau
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);
        $regionId = Auth::user()->region_id;
        Bureau::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'region_id' => $regionId,
        ]);
        return redirect()->route('adminRegion.bureau.index')
                         ->with('success', 'Bureau ajouté avec succès.');
    }

    /**
     * Afficher un bureau
     */
    public function show(Bureau $bureau)
    {
        $bureau->load('region');
    return view('adminRegion.bureau.show', compact('bureau'));
    }

    /**
     * Formulaire d’édition
     */
    public function edit(Bureau $bureau)
    {
        // La région courante
        $regionId = Auth::user()->region_id;
        return view('adminRegion.bureau.edit', compact('bureau', 'regionId'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, Bureau $bureau)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);
        $regionId = Auth::user()->region_id;
        $bureau->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'region_id' => $regionId,
        ]);
        return redirect()->route('adminRegion.bureau.index')
                         ->with('success', 'Bureau mis à jour avec succès.');
    }

    /**
     * Suppression
     */
    public function destroy(Bureau $bureau)
    {
        $bureau->delete();

    return redirect()->route('adminRegion.bureau.index')
                         ->with('success', 'Bureau supprimé avec succès.');
    }
}
