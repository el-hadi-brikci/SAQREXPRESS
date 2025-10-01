<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Bureau;
use App\Models\Region;
use Illuminate\Http\Request;

class BureauController extends Controller
{
    public function index()
    {
        $bureaux = Bureau::with('region')->get();
        return view('adminGlobal.bureaux.index', compact('bureaux'));
    }

    public function create()
    {
        $regions = Region::all();
        return view('adminGlobal.bureaux.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
        ]);

        Bureau::create($request->only(['nom', 'adresse', 'region_id']));

        return redirect()->route('employe.bureaux.index')
                         ->with('success', 'Bureau ajout\u00e9 avec succ\u00e8s.');
    }

    public function show(Bureau $bureau)
    {
        $bureau->load('region');
        return view('adminGlobal.bureaux.show', compact('bureau'));
    }

    public function edit(Bureau $bureau)
    {
        $regions = Region::all();
        return view('adminGlobal.bureaux.edit', compact('bureau', 'regions'));
    }

    public function update(Request $request, Bureau $bureau)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
        ]);

        $bureau->update($request->only(['nom', 'adresse', 'region_id']));

        return redirect()->route('employe.bureaux.index')
                         ->with('success', 'Bureau mis \u00e0 jour avec succ\u00e8s.');
    }

    public function destroy(Bureau $bureau)
    {
        $bureau->delete();

        return redirect()->route('employe.bureaux.index')
                         ->with('success', 'Bureau supprim\u00e9 avec succ\u00e8s.');
    }
}
