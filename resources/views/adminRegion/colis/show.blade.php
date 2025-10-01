@extends('adminRegion.layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-saqr-blue mb-6">Détail du colis</h1>
    <div class="bg-white shadow rounded p-6">
        <div class="mb-4">
            <span class="font-semibold">Code Suivi :</span> {{ $colis->code_suivi }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Client :</span> {{ $colis->client->nom ?? '—' }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Départ :</span> {{ $colis->bureau->nom ?? '—' }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Destination :</span> {{ $colis->bureauDestination->nom ?? '—' }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Statut :</span> {{ ucfirst($colis->statut) }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Description :</span> {{ $colis->description ?? '—' }}
        </div>
        <div class="mb-4">
            <span class="font-semibold">Poids :</span> {{ $colis->poids ?? '—' }} kg
        </div>
        <div class="mb-4">
            <span class="font-semibold">Date livraison réelle :</span> {{ $colis->date_livraison_reelle ? $colis->date_livraison_reelle->format('d/m/Y H:i') : '—' }}
        </div>
        <div class="flex space-x-4 mt-6">
            <a href="{{ route('admin.region.colis.edit', $colis) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Modifier</a>
            <form method="POST" action="{{ route('admin.region.colis.destroy', $colis) }}" onsubmit="return confirm('Supprimer ce colis ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
