<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Colis;
use Illuminate\Http\Request;

class ColisController extends Controller
{
    /**
     * GET /api/colis
     * Optional query: search, jour (YYYY-MM-DD)
     */
    public function index(Request $request)
    {
        $query = Colis::with(['client', 'bureau', 'bureauDestination', 'saisiParUser']);

        if ($request->filled('search')) {
            $query->where('code_suivi', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('jour')) {
            $query->whereDate('created_at', $request->jour);
        }

        $colis = $query->orderBy('created_at', 'desc')->paginate(20);
        return response()->json($colis);
    }

    /**
     * GET /api/colis/{colis}
     */
    public function show(Colis $colis)
    {
        $colis->load(['client', 'bureau', 'bureauDestination', 'saisiParUser']);
        return response()->json($colis);
    }

    /**
     * GET /api/tracking/{code_suivi}
     * Public endpoint
     */
    public function tracking($code_suivi)
    {
        $colis = Colis::with(['client', 'bureau', 'bureauDestination'])
            ->where('code_suivi', $code_suivi)
            ->first();

        if (! $colis) {
            return response()->json(['error' => 'Colis introuvable'], 404);
        }

        return response()->json([
            'code_suivi' => $colis->code_suivi,
            'description' => $colis->description,
            'statut' => ucfirst($colis->statut),
            'bureau_depart' => $colis->bureau->nom ?? '-',
            'bureau_destination' => $colis->bureauDestination->nom ?? '-',
            'client' => $colis->client->nom ?? '-',
            'poids' => $colis->poids ?? '-',
            'prix' => $colis->prix ?? '-',
            'heure_saisie' => $colis->heure_saisie ?? null,
        ]);
    }
}
                    $colis = $query->orderBy('created_at', 'desc')->paginate(20);
