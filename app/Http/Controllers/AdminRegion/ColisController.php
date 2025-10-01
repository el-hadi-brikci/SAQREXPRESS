<?php

namespace App\Http\Controllers\AdminRegion;

use App\Http\Controllers\Controller;
use App\Models\Colis;
use App\Models\Client;
use App\Models\Bureau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColisController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        // On récupère les bureaux de la région courante
        $regionBureauIds = \App\Models\Bureau::where('region_id', $user->region_id)->pluck('id')->toArray();
        $query = Colis::with(['client', 'bureau', 'bureauDestination', 'saisiParUser'])
            ->where(function ($q) use ($regionBureauIds) {
                $q->whereIn('bureau_id', $regionBureauIds)
                  ->orWhereIn('bureau_destination_id', $regionBureauIds);
            });
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('code_suivi', 'like', '%' . $request->search . '%')
                  ->orWhere('code_barre', 'like', '%' . $request->search . '%');
            });
        }
        $colis = $query->paginate(10);
        return view('adminRegion.colis.index', compact('colis'));
    }

    public function create()
    {
    $clients = Client::all();
    $bureaux = Bureau::all();
    return view('adminRegion.colis.create', compact('clients', 'bureaux'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_suivi' => 'required|unique:colis,code_suivi',
            'description' => 'nullable|string',
            'poids' => 'nullable|numeric',
            'statut' => 'required|in:en_attente,en_cours,livré,annulé',
            'bureau_id' => 'required|exists:bureaux,id',
            'client_id' => 'required|exists:clients,id',
            'code_barre' => 'required|string|unique:colis,code_barre',
            'numero_voiture' => 'nullable|string',
            'telephone_chauffeur' => 'nullable|string',
            'telephone_envoyeur' => 'nullable|string',
            'telephone_receveur' => 'nullable|string',
            'bureau_destination_id' => 'nullable|exists:bureaux,id',
            'date_livraison_reelle' => 'nullable|date',
        ]);
        $validated['saisi_par'] = Auth::id();
        Colis::create($validated);
    return redirect()->route('adminRegion.colis.index')
             ->with('success', 'Colis ajouté avec succès ✅');
    }

    public function show(Colis $colis)
    {
    $colis->load(['client', 'bureau', 'bureauDestination', 'saisiParUser']);
    return view('adminRegion.colis.show', compact('colis'));
    }

    public function edit(Colis $colis)
    {
    $clients = Client::all();
    $bureaux = Bureau::all();
    return view('adminRegion.colis.edit', compact('colis', 'clients', 'bureaux'));
    }

    public function update(Request $request, Colis $colis)
    {
        $validated = $request->validate([
            'code_suivi' => 'required|string|unique:colis,code_suivi,' . $colis->id,
            'description' => 'nullable|string',
            'poids' => 'nullable|numeric',
            'statut' => 'required|in:en_attente,en_cours,livré,annulé',
            'client_id' => 'nullable|exists:clients,id',
            'bureau_id' => 'nullable|exists:bureaux,id',
            'code_barre' => 'nullable|string|unique:colis,code_barre,' . $colis->id,
            'numero_voiture' => 'nullable|string',
            'telephone_chauffeur' => 'nullable|string',
            'telephone_envoyeur' => 'nullable|string',
            'telephone_receveur' => 'nullable|string',
            'bureau_destination_id' => 'nullable|exists:bureaux,id',
            'date_livraison_reelle' => 'nullable|date',
        ]);
        $colis->update(array_merge($validated, [
            'saisi_par' => Auth::id(),
        ]));
    return redirect()->route('adminRegion.colis.index')
             ->with('success', 'Colis mis à jour avec succès ✅');
    }

    public function destroy(Colis $colis)
    {
    $colis->delete();
    return redirect()->route('adminRegion.colis.index')
             ->with('success', 'Colis supprimé avec succès.');
    }

    public function ticket(Colis $colis)
    {
        $colis->load(['client', 'bureau']);
        return view('admin.region.colis.ticket', compact('colis'));
    }

    public function track($code_suivi)
    {
        $colis = Colis::with(['client', 'bureau'])->where('code_suivi', $code_suivi)->first();
        if (!$colis) {
            return response()->json(['error' => 'Colis introuvable'], 404);
        }
        return response()->json([
            'code_suivi' => $colis->code_suivi,
            'description' => $colis->description,
            'statut' => ucfirst($colis->statut),
            'bureau' => $colis->bureau->nom ?? '-',
            'client' => $colis->client->nom ?? '-',
        ]);
    }
}
