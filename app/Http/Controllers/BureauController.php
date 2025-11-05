<?php

namespace App\Http\Controllers;

use App\Models\Bureau;
use App\Models\Region;
use Illuminate\Http\Request;

class BureauController extends Controller
{
    /**
     * Liste des bureaux
     */
    public function index()
    {
        $bureaux = Bureau::with('region')->get();
        return view('adminGlobal.bureau.index', compact('bureaux'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $regions = Region::all();
        return view('adminGlobal.bureau.create', compact('regions'));
    }

    /**
     * Enregistrer un nouveau bureau
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'wilaya_number' => 'nullable|integer|min:1|max:99',
        ]);

        Bureau::create($request->only(['nom', 'adresse', 'region_id', 'wilaya_number']));

        return redirect()->route('admin.global.bureau.index')
                         ->with('success', 'Bureau ajouté avec succès.');
    }

    /**
     * Afficher un bureau
     */
    public function show(Bureau $bureau)
    {
        $bureau->load('region');
        return view('adminGlobal.bureau.show', compact('bureau'));
    }

    /**
     * Formulaire d’édition
     */
    public function edit(Bureau $bureau)
    {
        $regions = Region::all();
        return view('adminGlobal.bureau.edit', compact('bureau', 'regions'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, Bureau $bureau)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'wilaya_number' => 'nullable|integer|min:1|max:99',
        ]);

        $bureau->update($request->only(['nom', 'adresse', 'region_id', 'wilaya_number']));

        return redirect()->route('admin.global.bureau.index')
                         ->with('success', 'Bureau mis à jour avec succès.');
    }

    /**
     * Suppression
     */
    public function destroy(Bureau $bureau)
    {
        $bureau->delete();

        return redirect()->route('admin.global.bureau.index')
                         ->with('success', 'Bureau supprimé avec succès.');
    }
}
