<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        return response()->json(Region::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|string|unique:regions,nom']);
        $region = Region::create(['nom' => $request->nom]);
        return response()->json($region, 201);
    }

    public function show(Region $region)
    {
        return response()->json($region, 200);
    }

    public function update(Request $request, Region $region)
    {
        $request->validate(['nom' => 'required|string|unique:regions,nom,' . $region->id]);
        $region->update(['nom' => $request->nom]);
        return response()->json($region, 200);
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return response()->json(['message' => 'Région supprimée'], 200);
    }
}
