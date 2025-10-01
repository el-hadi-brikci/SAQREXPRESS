<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Liste toutes les régions
     */
    public function index()
    {
        $regions = Region::all();
        return view('adminGlobal.regions.index', compact('regions'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('adminGlobal.regions.create');
    }

    /**
     * Enregistre une nouvelle région
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|unique:regions,nom'
        ]);

        Region::create([
            'nom' => $request->nom
        ]);

        return redirect()
            ->route('admin.global.regions.index')
            ->with('success', 'Région ajoutée avec succès.');
    }

    /**
     * Affiche une seule région
     */
    public function show(Region $region)
    {
        return view('adminGlobal.regions.show', compact('region'));
    }

    /**
     * Formulaire d’édition d’une région
     */
    public function edit(Region $region)
    {
        return view('adminGlobal.regions.edit', compact('region'));
    }

    /**
     * Mise à jour d’une région
     */
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'nom' => 'required|string|unique:regions,nom,' . $region->id
        ]);

        $region->update([
            'nom' => $request->nom
        ]);

        return redirect()
            ->route('admin.global.regions.index')
            ->with('success', 'Région mise à jour avec succès.');
    }

    /**
     * Suppression d’une région
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()
            ->route('admin.global.regions.index')
            ->with('success', 'Région supprimée avec succès.');
    }
}
