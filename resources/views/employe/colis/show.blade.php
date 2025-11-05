@extends('employe.layouts.layout')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-saqr-blue mb-6">📦 Détails du Colis</h1>
    <div class="bg-white shadow-md rounded-lg border border-gray-200 p-6 space-y-4">
        <p class="mb-2"><strong>ID :</strong> {{ $colis->id }}</p>
        <p class="mb-2"><strong>Code suivi :</strong> {{ $colis->code_suivi }}</p>
        <p class="mb-2"><strong>Description :</strong> {{ $colis->description }}</p>
        <p class="mb-2"><strong>Poids :</strong> {{ $colis->poids }} kg</p>
        <p class="mb-2"><strong>Client :</strong> {{ $colis->client->nom ?? '-' }}</p>
        <p class="mb-2"><strong>Bureau :</strong> {{ $colis->bureau->nom ?? '-' }}</p>
        <p class="mb-2"><strong>Bureau de destination :</strong> {{ $colis->bureauDestination->nom ?? '-' }}</p>
        <p class="mb-2"><strong>Prix :</strong> {{ number_format($colis->prix, 2) }} DA</p>
        <p>
            <strong>Statut :</strong>
            <span class="px-2 py-1 rounded text-white {{ [
                'en_attente' => 'bg-yellow-500',
                'en_cours' => 'bg-blue-500',
                'livré' => 'bg-green-500',
            ][$colis->statut] ?? 'bg-red-500' }}">
                {{ ucfirst($colis->statut) }}
            </span>
        </p>
        <p><strong>Saisi par :</strong> {{ $colis->saisiParUser->name ?? '-' }}</p>
        <p><strong>Date de livraison réelle :</strong> 
            {{ $colis->date_livraison_reelle ? $colis->date_livraison_reelle->format('d/m/Y H:i') : '-' }}
        </p>
    </div>
    <div class="flex justify-end mt-6 space-x-3">
        <a href="{{ route('employe.colis.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">⬅ Retour</a>
        <a href="{{ route('employe.colis.edit', $colis) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Modifier</a>
        <form action="{{ route('employe.colis.destroy', $colis) }}" method="POST" onsubmit="return confirm('Supprimer ce colis ?')">
            @csrf @method('DELETE')
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Supprimer</button>
        </form>
        <a href="{{ route('employe.colis.ticket', $colis) }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 hover:bg-blue-700 transition">Imprimer le ticket</a>
    </div>
</div>
@endsection