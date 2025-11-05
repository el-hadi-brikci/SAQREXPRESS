<?php

namespace App\Http\Controllers\Employe;

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

        $query = Colis::with(['client', 'bureau', 'bureauDestination', 'saisiParUser'])
            ->where(function ($q) use ($user) {
                $q->where('bureau_id', $user->bureau_id)
                  ->orWhere('bureau_destination_id', $user->bureau_id);
            });

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('code_suivi', 'like', '%' . $request->search . '%')
                  ->orWhere('code_barre', 'like', '%' . $request->search . '%');
            });
        }

        // Filtre par journée
        if ($request->filled('jour')) {
            $jour = $request->jour;
            $query->whereDate('created_at', $jour);
        }

        // Tri du plus récent au plus ancien
        $colis = $query->orderBy('created_at', 'desc')->get();

        return view('employe.colis.index', compact('colis'));
    }

    public function create()
    {
        $clients = Client::all();
        $bureaux = Bureau::all();
        return view('employe.colis.create', compact('clients', 'bureaux'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_suivi' => 'required|unique:colis,code_suivi',
            'description' => 'nullable|string',
            'poids' => 'nullable|numeric',
            'prix' => 'required|numeric',
            'statut' => 'required|in:en_attente,en_cours,livr\u00e9,annul\u00e9',
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

        return redirect()->route('employe.colis.index')
                         ->with('success', 'Colis ajout\u00e9 avec succ\u00e8s \u2705');
    }

    public function show(Colis $colis)
    {
        $colis->load(['client', 'bureau', 'bureauDestination', 'saisiParUser']);
        return view('employe.colis.show', compact('colis'));
    }

    public function edit(Colis $colis)
    {
        $clients = Client::all();
        $bureaux = Bureau::all();
        return view('employe.colis.edit', compact('colis', 'clients', 'bureaux'));
    }

    public function update(Request $request, Colis $colis)
{
    $validated = $request->validate([
        'code_suivi' => 'required|string|unique:colis,code_suivi,' . $colis->id,
        'description' => 'nullable|string',
        'poids' => 'nullable|numeric',
        'prix' => 'required|numeric',
        'statut' => 'required|in:en_attente,en_cours,livr\u00e9,annul\u00e9',
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

    return redirect()->route('employe.colis.index')
                     ->with('success', 'Colis mis \u00e0 jour avec succ\u00e8s \u2705');
}


    public function destroy(Colis $colis)
    {
        $colis->delete();
        return redirect()->route('employe.colis.index')
                     ->with('success', 'Colis supprim\u00e9 avec succ\u00e8s.');
    }

    public function ticket(Colis $colis)
    {
        $colis->load(['client', 'bureau']);
        return view('employe.colis.ticket', compact('colis'));
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
