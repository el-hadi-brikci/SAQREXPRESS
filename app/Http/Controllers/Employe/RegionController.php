<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('adminGlobal.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('adminGlobal.regions.create');
    }

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
            ->with('success', 'R\u00e9gion ajout\u00e9e avec succ\u00e8s.');
    }

    public function show(Region $region)
    {
        return view('adminGlobal.regions.show', compact('region'));
    }

    public function edit(Region $region)
    {
        return view('adminGlobal.regions.edit', compact('region'));
    }

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
            ->with('success', 'R\u00e9gion mise \u00e0 jour avec succ\u00e8s.');
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()
            ->route('admin.global.regions.index')
            ->with('success', 'R\u00e9gion supprim\u00e9e avec succ\u00e8s.');
    }
}
